<?php namespace Script57\FileValidation;

class FileValidationException extends \RuntimeException {

	/**
	 * File validation error messages.
	 *
	 * @var mixed
	 */
	protected $errors;


	/**
	 * Set the validation error messages.
	 *
	 * @param  $errors
	 * @return FileValidationException
	 */
	public function setErrors($errors)
	{
		$this->errors = $errors;
		$this->message = "The file validation failed.";

		return $this;
	}

	/**
	 * Get the validation error messages.
	 *
	 * @return string
	 */
	public function getErrors()
	{
		return $this->errors;
	}    

}
