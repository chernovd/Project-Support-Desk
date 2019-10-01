


<div class="container">
    <div class='banner'>
            <h1>Stenden|Support</h1>
            <p>Ready to assist you with anything!</p>
    </div>
    <div class="menu">
        <div class="box largebox">
            <a href="memberprofile.php?page=ticket"><img src="img/faq.png" alt="ticket icon"></a>
            <p>Submit a new ticket</p>
        </div>
        <div class="box largebox">
            <a href="memberprofile.php?page=overview"><img src="img/renew.png" alt="overview icon"></a>
            <p>Overview of my submitted tickets</p>
        </div>
    </div>
    
    <div class="ticketsubmit">        
                                <h2>Submit ticket</h2>
								<form class="ticketform" method="POST" action="new_incident.php">
					            <p>Operating System:</p>
					            <input type="radio" name="OS" value="Linux"Linux>Linux
					            <input type="radio" name="OS" value="Mac">Mac
					            <input type="radio" name="OS" value="Windows"Windows>Windows
                                <p>Software Version</p>
                                <input type="text" name="software"/>
                                <p>Category(choose the one most suitablefor your problem)</p>
                                <select name="category">
                                    <option value="1" >Wish</option>
                                    <option value="2" >Crash</option>
                                    <option value="3" >Functional Problem</option>
                                    <option value="4" selected>Technical Problem</option>
                                </select>
                                
                                <p>Problem Description</p>
                                <textarea name="description" placeholder="..."></textarea><br>
					            <input type="submit" name='submit' value="Submit" />
					            
                                </form>
                                
                                <?php  
                                    if(isset($_GET['error']))
                                    {
                                        if($_GET['error'] == 'empty')
                                        {
                                            echo '<p>All the fields must be filled in!</p>';
                                        } 
                                       
                                    }
                                    elseif (isset($_GET['success']))
                                    {
                                        echo '<p>Thank you for submitting the ticket.'
                                        . ' An employee will provide you with an answer in the shortest period of time.</p>';
                                    }
                                ?>
</div>
</div>