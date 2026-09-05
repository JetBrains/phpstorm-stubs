<?php

// PECL stats stubs for PhpStorm
// https://pecl.php.net/package/stats
// https://www.php.net/manual/en/book.stats.php

// by @yoosefi

/**
 * Returns the absolute deviation of the values in a, or FALSE if a is empty or is not an array.
 *
 * @link https://www.php.net/manual/en/function.stats-absolute-deviation.php
 * @param array $a The input array
 * @return float|false Returns the absolute deviation of the values in a, or false if a is empty or
 * is not an array.
 */
function stats_absolute_deviation(array $a) {}

/**
 * Returns CDF, x, alpha, or beta, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-beta.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, alpha, or beta, determined by which.
 */
function stats_cdf_beta(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, n, or p, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-binomial.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, n, or p, determined by which.
 */
function stats_cdf_binomial(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, x0, or gamma, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-cauchy.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, x0, or gamma, determined by which.
 */
function stats_cdf_cauchy(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, or k, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-chisquare.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, or k, determined by which.
 */
function stats_cdf_chisquare(float $par1, float $par2, int $which): float {}

/**
 * Returns CDF, x, or lambda, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-exponential.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, or lambda, determined by which.
 */
function stats_cdf_exponential(float $par1, float $par2, int $which): float {}

/**
 * Returns CDF, x, d1, or d2, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-f.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, d1, or d2, determined by which.
 */
function stats_cdf_f(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, k, or theta, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-gamma.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, k, or theta, determined by which.
 */
function stats_cdf_gamma(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, mu, or b, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-laplace.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, mu, or b, determined by which.
 */
function stats_cdf_laplace(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, mu, or s, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-logistic.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, mu, or s, determined by which.
 */
function stats_cdf_logistic(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, r, or p, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-negative-binomial.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, r, or p, determined by which.
 */
function stats_cdf_negative_binomial(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, k, or lambda, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-noncentral-chisquare.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, k, or lambda, determined by which.
 */
function stats_cdf_noncentral_chisquare(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, nu1, nu2, or lambda, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-noncentral-f.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param float $par4 The fourth parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, nu1, nu2, or lambda, determined by which.
 */
function stats_cdf_noncentral_f(float $par1, float $par2, float $par3, float $par4, int $which): float {}

/**
 * Returns CDF, x, nu, or mu, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-noncentral-t.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, nu, or mu, determined by which.
 */
function stats_cdf_noncentral_t(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, mu, or sigma, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-normal.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, mu, or sigma, determined by which.
 */
function stats_cdf_normal(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, or lambda, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-poisson.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, or lambda, determined by which.
 */
function stats_cdf_poisson(float $par1, float $par2, int $which): float {}

/**
 * Returns CDF, x, or nu, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-t.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, or nu, determined by which.
 */
function stats_cdf_t(float $par1, float $par2, int $which): float {}

/**
 * Returns CDF, x, a, or b, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-uniform.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, a, or b, determined by which.
 */
function stats_cdf_uniform(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns CDF, x, k, or lambda, determined by which.
 *
 * @link https://www.php.net/manual/en/function.stats-cdf-weibull.php
 * @param float $par1 The first parameter
 * @param float $par2 The second parameter
 * @param float $par3 The third parameter
 * @param int $which The flag to determine what to be calculated
 * @return float Returns CDF, x, k, or lambda, determined by which.
 */
function stats_cdf_weibull(float $par1, float $par2, float $par3, int $which): float {}

/**
 * Returns the covariance of a and b, or FALSE on failure.
 *
 * @link https://www.php.net/manual/en/function.stats-covariance.php
 * @param array $a The first array
 * @param array $b The second array
 * @return float|false Returns the covariance of a and b, or false on failure.
 */
function stats_covariance(array $a, array $b) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-beta.php
 * @param float $x The value at which the probability density is calculated
 * @param float $a The shape parameter of the distribution
 * @param float $b The shape parameter of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_beta(float $x, float $a, float $b) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-cauchy.php
 * @param float $x The value at which the probability density is calculated
 * @param float $ave The location parameter of the distribution
 * @param float $stdev The scale parameter of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_cauchy(float $x, float $ave, float $stdev) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-chisquare.php
 * @param float $x The value at which the probability density is calculated
 * @param float $dfr The degree of freedom of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_chisquare(float $x, float $dfr) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-exponential.php
 * @param float $x The value at which the probability density is calculated
 * @param float $scale The scale of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_exponential(float $x, float $scale) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-f.php
 * @param float $x The value at which the probability density is calculated
 * @param float $dfr1 The degree of freedom of the distribution
 * @param float $dfr2 The degree of freedom of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_f(float $x, float $dfr1, float $dfr2) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-gamma.php
 * @param float $x The value at which the probability density is calculated
 * @param float $shape The shape parameter of the distribution
 * @param float $scale The scale parameter of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_gamma(float $x, float $shape, float $scale) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-laplace.php
 * @param float $x The value at which the probability density is calculated
 * @param float $ave The location parameter of the distribution
 * @param float $stdev The shape parameter of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_laplace(float $x, float $ave, float $stdev) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-logistic.php
 * @param float $x The value at which the probability density is calculated
 * @param float $ave The location parameter of the distribution
 * @param float $stdev The shape parameter of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_logistic(float $x, float $ave, float $stdev) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-normal.php
 * @param float $x The value at which the probability density is calculated
 * @param float $ave The mean of the distribution
 * @param float $stdev The standard deviation of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_normal(float $x, float $ave, float $stdev) {}

/**
 * The probability mass at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-pmf-binomial.php
 * @param float $x The value at which the probability mass is calculated
 * @param float $n The number of trials of the distribution
 * @param float $pi The success rate of the distribution
 * @return float|false The probability mass at x or false for failure.
 */
function stats_dens_pmf_binomial(float $x, float $n, float $pi) {}

/**
 * The probability mass at n1 or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-pmf-hypergeometric.php
 * @param float $n1 The number of success, at which the probability mass is calculated
 * @param float $n2 The number of failure of the distribution
 * @param float $N1 The number of success samples of the distribution
 * @param float $N2 The number of failure samples of the distribution
 * @return float|false The probability mass at n1 or false for failure.
 */
function stats_dens_pmf_hypergeometric(float $n1, float $n2, float $N1, float $N2) {}

/**
 * The probability mass at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-pmf-negative-binomial.php
 * @param float $x The value at which the probability mass is calculated
 * @param float $n The number of the success of the distribution
 * @param float $pi The success rate of the distribution
 * @return float|false The probability mass at x or false for failure.
 */
function stats_dens_pmf_negative_binomial(float $x, float $n, float $pi) {}

/**
 * The probability mass at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-pmf-poisson.php
 * @param float $x The value at which the probability mass is calculated
 * @param float $lb The parameter of the Poisson distribution
 * @return float|false The probability mass at x or false for failure.
 */
function stats_dens_pmf_poisson(float $x, float $lb) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-t.php
 * @param float $x The value at which the probability density is calculated
 * @param float $dfr The degree of freedom of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_t(float $x, float $dfr) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-uniform.php
 * @param float $x The value at which the probability density is calculated
 * @param float $a The lower bound of the distribution
 * @param float $b The upper bound of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_uniform(float $x, float $a, float $b) {}

/**
 * The probability density at x or FALSE for failure.
 *
 * @link https://www.php.net/manual/en/function.stats-dens-weibull.php
 * @param float $x The value at which the probability density is calculated
 * @param float $a The shape parameter of the distribution
 * @param float $b The scale parameter of the distribution
 * @return float|false The probability density at x or false for failure.
 */
function stats_dens_weibull(float $x, float $a, float $b) {}

/**
 * Returns the harmonic mean of the values in a, or FALSE if a is empty or is not an array.
 *
 * @link https://www.php.net/manual/en/function.stats-harmonic-mean.php
 * @param array $a The input array
 * @return number|false Returns the harmonic mean of the values in a, or false if a is empty or is
 * not an array.
 */
function stats_harmonic_mean(array $a) {}

/**
 * Returns the kurtosis of the values in a, or FALSE if a is empty or is not an array.
 *
 * @link https://www.php.net/manual/en/function.stats-kurtosis.php
 * @param array $a The input array
 * @return float|false Returns the kurtosis of the values in a, or false if a is empty or is not an
 * array.
 */
function stats_kurtosis(array $a) {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-beta.php
 * @param float $a The shape parameter of the beta distribution
 * @param float $b The shape parameter of the beta distribution
 * @return float A random deviate
 */
function stats_rand_gen_beta(float $a, float $b): float {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-chisquare.php
 * @param float $df The degrees of freedom
 * @return float A random deviate
 */
function stats_rand_gen_chisquare(float $df): float {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-exponential.php
 * @param float $av The scale parameter
 * @return float A random deviate
 */
function stats_rand_gen_exponential(float $av): float {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-f.php
 * @param float $dfn The degrees of freedom in the numerator
 * @param float $dfd The degrees of freedom in the denominator
 * @return float A random deviate
 */
function stats_rand_gen_f(float $dfn, float $dfd): float {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-funiform.php
 * @param float $low The lower bound (exclusive)
 * @param float $high The upper bound (exclusive)
 * @return float A random deviate
 */
function stats_rand_gen_funiform(float $low, float $high): float {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-gamma.php
 * @param float $a location parameter of Gamma distribution (a > 0).
 * @param float $r shape parameter of Gamma distribution (r > 0).
 * @return float A random deviate
 */
function stats_rand_gen_gamma(float $a, float $r): float {}

/**
 * A random deviate, which is the number of failure.
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-ibinomial-negative.php
 * @param int $n The number of success
 * @param float $p The success rate
 * @return int A random deviate, which is the number of failure.
 */
function stats_rand_gen_ibinomial_negative(int $n, float $p): int {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-ibinomial.php
 * @param int $n The number of trials
 * @param float $pp The probability of an event in each trial
 * @return int A random deviate
 */
function stats_rand_gen_ibinomial(int $n, float $pp): int {}

/**
 * A random integer
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-int.php
 * @return int A random integer
 */
function stats_rand_gen_int(): int {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-ipoisson.php
 * @param float $mu The parameter of the Poisson distribution
 * @return int A random deviate
 */
function stats_rand_gen_ipoisson(float $mu): int {}

/**
 * A random integer
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-iuniform.php
 * @param int $low The lower bound
 * @param int $high The upper bound
 * @return int A random integer
 */
function stats_rand_gen_iuniform(int $low, int $high): int {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-noncentral-f.php
 * @param float $dfn The degrees of freedom of the numerator
 * @param float $dfd The degrees of freedom of the denominator
 * @param float $xnonc The non-centrality parameter
 * @return float A random deviate
 */
function stats_rand_gen_noncentral_f(float $dfn, float $dfd, float $xnonc): float {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-noncentral-t.php
 * @param float $df The degrees of freedom
 * @param float $xnonc The non-centrality parameter
 * @return float A random deviate
 */
function stats_rand_gen_noncentral_t(float $df, float $xnonc): float {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-normal.php
 * @param float $av The mean of the normal distribution
 * @param float $sd The standard deviation of the normal distribution
 * @return float A random deviate
 */
function stats_rand_gen_normal(float $av, float $sd): float {}

/**
 * A random deviate
 *
 * @link https://www.php.net/manual/en/function.stats-rand-gen-t.php
 * @param float $df The degrees of freedom
 * @return float A random deviate
 */
function stats_rand_gen_t(float $df): float {}

/**
 * Returns an array of two integers.
 *
 * @link https://www.php.net/manual/en/function.stats-rand-get-seeds.php
 * @return int[] Returns an array of two integers.
 */
function stats_rand_get_seeds() {}

/**
 * Returns an array of two integers.
 *
 * @link https://www.php.net/manual/en/function.stats-rand-phrase-to-seeds.php
 * @param string $phrase The input phrase
 * @return int[] Returns an array of two integers.
 */
function stats_rand_phrase_to_seeds(string $phrase) {}

/**
 * A random floating point number
 *
 * @link https://www.php.net/manual/en/function.stats-rand-ranf.php
 * @return float A random floating point number
 */
function stats_rand_ranf(): float {}

/**
 * No values are returned.
 *
 * @link https://www.php.net/manual/en/function.stats-rand-setall.php
 * @param int $iseed1 The value which is used as the random seed
 * @param int $iseed2 The value which is used as the random seed
 */
function stats_rand_setall(int $iseed1, int $iseed2): void {}

/**
 * Returns the skewness of the values in a, or FALSE if a is empty or is not an array.
 *
 * @link https://www.php.net/manual/en/function.stats-skew.php
 * @param array $a The input array
 * @return float|false Returns the skewness of the values in a, or false if a is empty or is not an
 * array.
 */
function stats_skew(array $a) {}

/**
 * Returns the standard deviation on success; FALSE on failure.
 * Raises an E_WARNING when there are fewer than 2 values in a.
 *
 * @link https://www.php.net/manual/en/function.stats-standard-deviation.php
 * @param array $a The array of data to find the standard deviation for. Note that all values of the
 * array will be cast to float.
 * @param bool $sample Indicates if a represents a sample of the population; defaults to false.
 * @return float|false Returns the standard deviation on success; false on failure.
 */
function stats_standard_deviation(array $a, bool $sample = false) {}

/**
 * Returns the binomial coefficient
 *
 * @link https://www.php.net/manual/en/function.stats-stat-binomial-coef.php
 * @param int $x The number of chooses from the set
 * @param int $n The number of elements in the set
 * @return float Returns the binomial coefficient
 */
function stats_stat_binomial_coef(int $x, int $n): float {}

/**
 * Returns the Pearson correlation coefficient between arr1 and arr2, or FALSE on failure.
 *
 * @link https://www.php.net/manual/en/function.stats-stat-correlation.php
 * @param array $arr1 The first array
 * @param array $arr2 The second array
 * @return float|false Returns the Pearson correlation coefficient between arr1 and arr2, or false
 * on failure.
 */
function stats_stat_correlation(array $arr1, array $arr2) {}

/**
 * The factorial of n.
 *
 * @link https://www.php.net/manual/en/function.stats-stat-factorial.php
 * @param int $n An integer
 * @return float The factorial of n.
 */
function stats_stat_factorial(int $n): float {}

/**
 * Returns the t-value, or FALSE if failure.
 *
 * @link https://www.php.net/manual/en/function.stats-stat-independent-t.php
 * @param array $arr1 The first set of values
 * @param array $arr2 The second set of values
 * @return float|false
 */
function stats_stat_independent_t(array $arr1, array $arr2) {}

/**
 * Returns the inner product of arr1 and arr2, or FALSE on failure.
 *
 * @link https://www.php.net/manual/en/function.stats-stat-innerproduct.php
 * @param array $arr1 The first array
 * @param array $arr2 The second array
 * @return float|false Returns the inner product of arr1 and arr2, or false on failure.
 */
function stats_stat_innerproduct(array $arr1, array $arr2) {}

/**
 * Returns the t-value, or FALSE if failure.
 *
 * @link https://www.php.net/manual/en/function.stats-stat-paired-t.php
 * @param array $arr1 The first samples
 * @param array $arr2 The second samples
 * @return float|false Returns the t-value, or false if failure.
 */
function stats_stat_paired_t(array $arr1, array $arr2) {}

/**
 * Returns the percentile values of the input array.
 *
 * @link https://www.php.net/manual/en/function.stats-stat-percentile.php
 * @param array $array
 * @param float $perc The percentile
 * @return float Returns the percentile values of the input array.
 */
function stats_stat_percentile(array $array, float $perc): float {}

/**
 * Returns the power sum of the input array.
 *
 * @link https://www.php.net/manual/en/function.stats-stat-powersum.php
 * @param array $array
 * @param float $power The power
 * @return float Returns the power sum of the input array.
 */
function stats_stat_powersum(array $array, float $power): float {}

/**
 * Returns the variance on success; FALSE on failure.
 *
 * @link https://www.php.net/manual/en/function.stats-variance.php
 * @param array $a The array of data to find the standard deviation for. Note that all values of the
 * array will be cast to float.
 * @param bool $sample Indicates if a represents a sample of the population; defaults to false.
 * @return float|false Returns the variance on success; false on failure.
 */
function stats_variance(array $a, bool $sample = false) {}
