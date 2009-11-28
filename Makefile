.PHONY : test-coverage

test-coverage :
	phpunit --syntax-check --coverage-html coverage test
