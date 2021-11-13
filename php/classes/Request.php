<?php

namespace request;

Class Request {

	/**
	 * Get the value of a query parameter in the $_GET array.
	 * @param string $sParamName the name of the parameter.
	 * @return ?string Parameter value or null if parameter doesn't exist.
	 */
	public static function getParam(string $sParamName) {
		if (isset($_GET[$sParamName])) {
			return $_GET[$sParamName];
		}

		return null;
	}
}