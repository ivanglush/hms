<?php

namespace App\Enums;


class RequestState extends AbstractEnum
{
    const WAITING_FOR_RESPONSE = "waiting_for_response";

    const ACCEPTED = "accepted";

    const REJECTED = "rejected";
}