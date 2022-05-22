<?php
declare(strict_types=1);

namespace Tests\Unit\Requests;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;
use Tests\CreatesApplication;

class UserRequestTest extends TestCase
{

    use CreatesApplication;

    private const CORRECT_PASSWORD = 'goodPassword';
    private const CORRECT_EMAIL = 'email@email.com';
    private const CORRECT_NAME = 'uname';

    private const PASSWORD_CONFIRMATION = 'password_confirmation';

    /** @dataProvider formDataProvider */
    public function testValidationRules(array $formData, bool $isInvalid): void
    {
        $request = new UserRequest();
        $validator = Validator::make($formData, $request->rules());
        $this->assertEquals($isInvalid, $validator->fails());
    }

    public function testValidationWithIdSet(): void
    {
        $request = new UserRequest();
        $request->id = 2;
        $validator = Validator::make([
            UserService::NAME => self::CORRECT_NAME,
            UserService::EMAIL => self::CORRECT_EMAIL
        ], $request->rules());
        $this->assertFalse($validator->fails());
    }

    public function formDataProvider(): array
    {
        return [
            [
                [
                    UserService::PASSWORD => 'short',
                    UserService::EMAIL => self::CORRECT_EMAIL,
                    UserService::NAME => self::CORRECT_NAME,
                    self::PASSWORD_CONFIRMATION => 'short'
                ],
                true
            ],
            [
                [
                    UserService::PASSWORD => self::CORRECT_PASSWORD,
                    UserService::EMAIL => 'bademail',
                    UserService::NAME => self::CORRECT_NAME,
                    self::PASSWORD_CONFIRMATION => self::CORRECT_PASSWORD
                ],
                true
            ],
            [
                [
                    UserService::PASSWORD => '',
                    UserService::EMAIL => self::CORRECT_EMAIL,
                    UserService::NAME => self::CORRECT_NAME,
                    self::PASSWORD_CONFIRMATION => self::CORRECT_PASSWORD
                ],
                true
            ],
            [
                [
                    UserService::PASSWORD => self::CORRECT_PASSWORD,
                    UserService::EMAIL => '',
                    UserService::NAME => self::CORRECT_NAME,
                    self::PASSWORD_CONFIRMATION => self::CORRECT_PASSWORD
                ],
                true
            ],
            [
                [
                    UserService::PASSWORD => self::CORRECT_PASSWORD,
                    UserService::EMAIL => self::CORRECT_EMAIL,
                    UserService::NAME => '',
                    self::PASSWORD_CONFIRMATION => self::CORRECT_PASSWORD
                ],
                true
            ],
            [
                [
                    UserService::PASSWORD => self::CORRECT_PASSWORD,
                    UserService::EMAIL => self::CORRECT_EMAIL,
                    UserService::NAME => 'u',
                    self::PASSWORD_CONFIRMATION => self::CORRECT_PASSWORD
                ],
                true
            ],
            [
                [
                    UserService::PASSWORD => self::CORRECT_PASSWORD,
                    UserService::EMAIL => self::CORRECT_EMAIL,
                    UserService::NAME => Random::generate(51),
                    self::PASSWORD_CONFIRMATION => self::CORRECT_PASSWORD
                ],
                true
            ],
            [
                [
                    UserService::PASSWORD => self::CORRECT_PASSWORD,
                    UserService::EMAIL => self::CORRECT_EMAIL,
                    UserService::NAME => self::CORRECT_NAME,
                    self::PASSWORD_CONFIRMATION => ''
                ],
                true
            ],
            [
                [
                    UserService::PASSWORD => self::CORRECT_PASSWORD,
                    UserService::EMAIL => self::CORRECT_EMAIL,
                    UserService::NAME => self::CORRECT_NAME,
                    self::PASSWORD_CONFIRMATION => self::CORRECT_PASSWORD
                ],
                false
            ]
        ];
    }

}
