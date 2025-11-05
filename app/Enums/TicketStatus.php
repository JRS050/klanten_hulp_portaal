<?php

namespace App\Enums;

enum TicketStatus:string
{
    case PENDING = 'Pending';
    case UNDER_REVIEW = 'Under Review';
    case RESOLVED = 'Resolved';
}
