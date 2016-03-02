<?php

namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository extends BaseRepository{

    public function getModel()
    {
        return new Ticket();

    }

    protected function selectTicketList()
    {
        return $this->newQuery()->selectRaw(
            'tickets.*,'
            . '(SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id=tickets.id) as num_comments,'
            . '(SELECT COUNT(*) FROM ticket_votes   WHERE ticket_votes.ticket_id=tickets.id) as num_votes'

        )->with('author');
    }

    public function paginateLates()
    {
        return $this->selectTicketList()
            ->orderBy('created_at','DESC')
            ->paginate(20);

    }

    public function paginateOpen()
    {
        return $this->selectTicketList()
            ->where('status','open')
            ->orderBy('created_at','DESC')
            ->paginate(20);

    }

    public function paginateClosed()
    {
        return $this->selectTicketList()
            ->where('status','closed')
            ->orderBy('created_at','DESC')
            ->paginate(10);

    }

    public function openNew($user, $title)
    {

        return $user->tickets()->create([
            'title'   => $title,
            'status' =>'open'

        ]);
    }


}