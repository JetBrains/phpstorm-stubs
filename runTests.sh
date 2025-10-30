#!/usr/bin/env bash

echo "Installing composer packages..."
docker-compose -f docker-compose.yml run test_runner composer install

echo "Checking PhpDoc..."
docker-compose -f docker-compose.yml run test_runner vendor/bin/phpunit --testsuite PhpDoc

echo "Checking Structure..."
docker compose -f docker-compose.yml run test_runner vendor/bin/phpunit --testsuite Structure

allPhpVersions=("7.1" "7.2" "7.3" "7.4" "8.0" "8.1" "8.2" "8.3" "8.4" "8.5")
phpVersions=("$@")
if [ ${#phpVersions[@]} -eq 0 ]; then
  phpVersions=("${allPhpVersions[@]}")
fi

for i in "${phpVersions[@]}"
do
  export PHP_VERSION=$i
  SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
  cd "$SCRIPT_DIR" || exit

  echo "Building docker container for PHP_$i..."
  docker compose -f docker-compose.yml build

  echo "Installing composer packages..."
  docker compose -f docker-compose.yml run test_runner composer install

  echo "Dumping reflection data to file $SCRIPT_DIR/ReflectionData.dat for PHP_$i..."
  docker compose -f docker-compose.yml run -e "PHP_VERSION=$i" php_under_test /usr/local/bin/php tests/Tools/dump-reflection-to-file.php ReflectionData.dat

  echo "Running tests against PHP_$i..."
  docker compose -f docker-compose.yml run -e "PHP_VERSION=$i" test_runner vendor/bin/phpunit --testsuite "PHP_$i"

  echo "Removing file $SCRIPT_DIR/ReflectionData.dat with reflection data for PHP_$i..."
  rm -f "$SCRIPT_DIR/ReflectionData.dat"
done
