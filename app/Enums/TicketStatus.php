<?php

namespace App;

enum TicketStatus:string
{
    case Pending = 'Pending';
    case UnderReview = 'Under Review';
    case Resolved = 'Resolved';
}
