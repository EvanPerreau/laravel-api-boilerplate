<?php

namespace App\Modules\Authentication\Actions;

use App\Modules\Authentication\Mails\EmailVerification;
use App\Modules\Authentication\Models\DTO\CreateUserRequestDTO;
use App\Modules\Authentication\Models\Entities\EmailVerificationCode;
use App\Modules\Authentication\Models\Entities\User;
use App\Modules\Authentication\Services\CodeGenerationService;
use App\Modules\Authentication\Services\EmailVerificationService;
use App\Modules\Exceptions\Http\HttpInternalServerException;
use App\Modules\Security\Services\CryptoService;
use Illuminate\Support\Facades\Mail;

class CreateUserAction
{
    private User $user;

    function __construct(
        private CryptoService $cryptoService,
        private EmailVerificationService $emailVerificationService,
    ){}

    /**
     * @throws HttpInternalServerException
     */
    function execute(CreateUserRequestDTO $dto):  void
    {
        if (!$this->createUser($dto)) throw new HttpInternalServerException("Failed to create user");
        $this->emailVerificationService->sendEmailVerification($this->user);
    }

    private function createUser(CreateUserRequestDTO $dto): bool
    {
        $user = new User();
        $user->name = $dto->name;
        $user->email = $dto->email;
        $user->password = $this->cryptoService->hash($dto->password);
        $user->referral_code = $dto->referral_code;
        $result = $user->save();
        $this->user = $user;
        return $result;
    }
}
