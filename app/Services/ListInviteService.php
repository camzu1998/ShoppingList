<?php /** @noinspection PhpFieldAssignmentTypeMismatchInspection */

namespace App\Services;

use App\Mail\ListInvite;
use App\Models\ShoppingList;
use App\Models\Token;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ListInviteService
{
    private Token $token;
    private ShoppingList $list;

    public function generateTokenAndSendMail(string $email): self
    {
        $this->generateToken();
        Mail::to($email)->send(new ListInvite($this->list, $this->token));

        return $this;
    }

    public function setList(?ShoppingList $list = null): self
    {
        if (!empty(session()->get('list')) && $list == null) {
            $this->list = ShoppingList::find(session()->get('list'));
            session()->forget('list');
        } else {
            $this->list = $list;
        }

        return $this;
    }

    public function setToken(?Token $token = null): self
    {
        if (!empty(session()->get('token')) && $token == null) {
            $this->token = Token::find(session()->get('token'));
            session()->forget('token');
        } else {
            $this->token = $token;
        }

        return $this;
    }

    public function accept(): self
    {
        if (!empty($this->token) && $this->checkToken()) {
            $this->lockToken();
            $this->list->users()->attach(auth()->user());
        }

        return $this;
    }

    private function checkToken(): bool
    {
        //Todo: compare expired_at Token column after RemoveExpiredTokens command/action is coded
        return !$this->token->is_used && $this->token->tokenable->id == $this->list->id; // True means the token is valid and can be used
    }

    private function lockToken(): self
    {
        $this->token->update([
            'is_used' => true
        ]);

        return $this;
    }

    private function generateToken(): self
    {
        $this->token = $this->list->tokens()->create([
            'user_id' => auth()->id(),
            'token' => Str::random(40),
            'expired_at' => now()->addDays(7)
        ]);

        return $this;
    }
}
