<?php namespace Script57\FileValidation;

use Illuminate\Support\Facades\Validator;

abstract class FileValidator {

    /**
     * The rules to be applied to the data.
     *
     * @var array
     */
    protected static $rules = array();


    /**
     * The array of custom error messages.
     *
     * @var array
     */
    protected static $messages = array();


    /**
     * Whether to throw a FileValidationException when validation fails, or just return false.
     *
     * @var bool
     */
    protected static $throwException = false;


    /**
     * The file to validate.
     *
     * @var mixed
     */
    protected $file;


    /**
     * The validator instance.
     *
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;


    /**
     * Constructor.
     *
     * @param mixed $file
     */
    public function __construct($file = null)
    {
        // Set file
        $this->file = $file;

        // Bootstrap
        $this->boot();
    }


    /**
     * Set up the validator.
     */
    protected function boot()
    {
        // Create validator
        $this->validator = Validator::make(
            array(
                'file' => $this->file
            ),
            array(
                'file' => static::$rules
            ),
            static::$messages
        );
    }


    /**
     * Validate the file.
     *
     * @param null $throwException
     * @return bool
     */
    public function validate($throwException = null)
    {
        if ($this->validator->passes())
        {
            return true;
        }
        else
        {
            if ($throwException === true || ($throwException !== false && static::$throwException))
            {
                // Throw file validation exception
                throw with(new FileValidationException)->setErrors($this->validator->errors());
            }

            return false;
        }
    }


    /**
     * Get the validation error messages.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }


    /**
     * Set the file.
     *
     * @param $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        // Update the validator
        $this->boot();

        return $this;
    }


    /**
     * Get the file.
     *
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * Get the validator instance.
     *
     * @return \Illuminate\Validation\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

}
