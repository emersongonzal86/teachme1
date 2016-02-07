<?php

use TeachMe\Entities\Ticket_comments;

class TicketCommentTableSeeder extends BaseSeeder
{
    protected $total = 250;

    /**
     * @return \TeachMe\Entities\Ticket_comments
     */
    public function getModel()
    {
        return new Ticket_comments();
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'user_id' => $this->getRandom('User')->id,
            'ticket_id' => $this->getRandom('Ticket')->id,
            'comment' => $faker->paragraph(),
            'link' => $faker->randomElement(['', '', $faker->url]),
        ];
    }
}
