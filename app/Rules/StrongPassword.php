<?php

namespace App\Rules;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{

    public $containsUpperCaseLetters = true;

    public $containsLowerCaseLetters = true;

    public $containsNumbers = true;

    public $containsSpecialCharacters = true;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // $this->containsUpperCaseLetters = (Str::lower($value) !== $value);
        // $this->containsLowerCaseLetters = (Str::upper($value) == $value);
        $this->containsUpperCaseLetters = ((bool) preg_match('/[A-Z]/', $value));
        $this->containsLowerCaseLetters = ((bool) preg_match('/[a-z]/', $value));
        $this->containsNumbers = ((bool) preg_match('/[0-9]/', $value));
        $this->containsSpecialCharacters = ((bool) preg_match('/[^A-Za-z0-9]/', $value));
        return ($this->containsUpperCaseLetters && $this->containsLowerCaseLetters && $this->containsSpecialCharacters && $this->containsNumbers);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $result = match(true) {

            ! $this->containsNumbers &&
            ! $this->containsUpperCaseLetters &&
            ! $this->containsLowerCaseLetters &&
            ! $this->containsSpecialCharacters => 'The :attribute must contain at least one lowercase character, one uppercase character, one number, and one special character.',

            $this->containsNumbers &&
            ! $this->containsUpperCaseLetters &&
            ! $this->containsLowerCaseLetters &&
            ! $this->containsSpecialCharacters => 'The :attribute must contain at least one lowercase character, one uppercase character, and one special character.',


            ! $this->containsNumbers &&
            $this->containsUpperCaseLetters &&
            ! $this->containsLowerCaseLetters &&
            ! $this->containsSpecialCharacters => 'The :attribute must contain at least one lowercase character, and one special character and one number.',

            ! $this->containsNumbers &&
            ! $this->containsUpperCaseLetters &&
            $this->containsLowerCaseLetters &&
            ! $this->containsSpecialCharacters => 'The :attribute must contain at least one uppercase character, and one special character and one number.',

            ! $this->containsNumbers &&
            ! $this->containsUpperCaseLetters &&
            ! $this->containsLowerCaseLetters &&
              $this->containsSpecialCharacters => 'The :attribute must contain at least one lowercase character, one uppercase character and one number.',

            $this->containsNumbers &&
            $this->containsUpperCaseLetters &&
            ! $this->containsLowerCaseLetters &&
            ! $this->containsSpecialCharacters => 'The :attribute must contain at least one lowercase character and one special character.',

            $this->containsNumbers &&
            ! $this->containsUpperCaseLetters &&
            $this->containsLowerCaseLetters &&
            ! $this->containsSpecialCharacters => 'The :attribute must contain at least one uppercase character and one special character.',
            
            $this->containsNumbers &&
            ! $this->containsUpperCaseLetters &&
            ! $this->containsLowerCaseLetters &&
            $this->containsSpecialCharacters => 'The :attribute must contain at least one uppercase character and one special character.',

            ! $this->containsNumbers &&
            $this->containsUpperCaseLetters &&
            $this->containsLowerCaseLetters &&
            ! $this->containsSpecialCharacters => 'The :attribute must contain at least one special character and one number.',

            ! $this->containsNumbers &&
            $this->containsUpperCaseLetters &&
            ! $this->containsLowerCaseLetters &&
            $this->containsSpecialCharacters => 'The :attribute must contain at least one lowercase character and one number.',

            ! $this->containsNumbers &&
            ! $this->containsUpperCaseLetters &&
            $this->containsLowerCaseLetters &&
            $this->containsSpecialCharacters => 'The :attribute must contain at least one uppercase character and one number.',

            ! $this->containsNumbers &&
            $this->containsUpperCaseLetters &&
            $this->containsLowerCaseLetters &&
            $this->containsSpecialCharacters => 'The :attribute must contain at least one number.',

            $this->containsNumbers &&
            ! $this->containsUpperCaseLetters &&
            $this->containsLowerCaseLetters &&
            $this->containsSpecialCharacters => 'The :attribute must contain at least one uppercase character.',

            $this->containsNumbers &&
            $this->containsUpperCaseLetters &&
            ! $this->containsLowerCaseLetters &&
            $this->containsSpecialCharacters => 'The :attribute must contain at least one lowercase character.',

            $this->containsNumbers &&
            $this->containsUpperCaseLetters &&
            $this->containsLowerCaseLetters &&
            ! $this->containsSpecialCharacters => 'The :attribute must contain at least one special character.',
            
        };

        return $result;
    }
}
