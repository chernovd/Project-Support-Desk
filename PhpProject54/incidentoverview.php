<div class="container">
    <div class='banner'>
            <h1>Stenden|Support</h1>
            
    </div>
    <div class="menu">
        <div class="box">
            <a href="teamleader.php?page=overview"><img src="img/overview.png" alt="ticket icon"></a>
            <p>Overview of all submitted tickets</p>
        </div>
        <div class="box">
            <a href="teamleader.php?page=overviewown"><img src="img/ticket.png" alt="overview icon"></a>
            <p>Overview my assigned tickets</p>
        </div>
        <div class="box">
            <a href="teamleader.php?page=incident"><img src="img/incident.png" alt="overview icon"></a>
            <p>Overview off incidents</p>
        </div>
    </div>
    <div class="ticketdisplay">
        <h2>Incident Overview</h2>
        <p>Chose a category to see all the tickets in it</p>
        <form class='ticketform' action='incident.php' method='post'>
            <input type='radio' name='category' value='1'>Wish
            <input type='radio' name='category' value='2' checked>Crash
            <input type='radio' name='category' value='3'>Functional problem
            <input type='radio' name='category' value='4'>Technical problem
            <br>
            <input type='submit' name='submit' value='Show tickets'>
        </form>
        
    </div>
</div>