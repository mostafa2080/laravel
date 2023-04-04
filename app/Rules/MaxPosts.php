<?php
namespace App\Rules;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxPosts implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $postCount = Post::where('user_id', $value)->count();
        if ($postCount >= 5) {
            $fail('You have exceeded the maximum number of posts allowed.');
        }
    }
    public function message()
    {
        return 'You have exceeded the maximum number of posts allowed.';
    }










}
