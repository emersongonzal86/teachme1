<?php
/**
 * Created by PhpStorm.
 * User: emerson
 * Date: 1/03/16
 * Time: 21:52
 */

namespace TeachMe\Repositories;


use TeachMe\Entities\Ticket;
use TeachMe\Entities\User;

class VoteRepository {

    public function vote(User $user,Ticket $ticket)

    {
        if($user->hasVoted($ticket)) return false;

        $user->voted()->attach($ticket);
        return true;
    }

    public function unvote(User $user,Ticket $ticket)
    {
        $user->voted()->detach($ticket);

    }

}