<template>
    <nav>
        <RouterLink :to="{name: 'myTickets'}">Tickets overview  </RouterLink>
        <RouterLink :to="{name: 'newTicket'}">New Ticket</RouterLink>
        <div>
            <RouterLink :to="{name: 'categories'}">Categories overview  </RouterLink>
        </div>
    </nav>
</template>