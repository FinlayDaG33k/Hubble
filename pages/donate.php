<?php
$json_address = json_decode(file_get_contents('https://blockchain.info/rawaddr/19HbRqc7RFnwvtMTKsC9FCWkDnre5JgACb'));
$json_ticker = json_decode(file_get_contents('https://blockchain.info/ticker'));

$btc_received = $json_address->total_received / 100000000;
$btc_donated = (($json_address->total_received / 100000000) / 100) * 75;
$btc_received_worth = number_format($btc_received * $json_ticker->EUR->sell, 2);
$btc_donated_worth = number_format($btc_donated * $json_ticker->EUR->sell, 2);
?>

Hubble is a free service that enables you to see if your servers are online.<br />
Because of the fact that it's free, I have to pay all the expenses by myself.<br />
If you would like to help keeping Hubble alive, please consider making a donation.<br />
Currently, I only accept donations trough Bitcoin as Bitcoins are one of my favorite currencies!.<br />
<br />
Because I'm not a greedy person, 75% of the Bitcoin donated to <a href="http://leergeldarnhem.nl/" target="_new">"Stichting Leergeld Arnhem"</a> :)<br />
Hubble's Bitcoin address: <?php echo $json_address->address;?><br />
<br />
Hubble has received a total of <i class="fa fa-btc" aria-hidden="true"><?php echo $btc_received;?></i> (<i class="fa fa-eur" aria-hidden="true"><?php echo $btc_received_worth;?></i>),<br />
of which <i class="fa fa-btc" aria-hidden="true"><?php echo $btc_donated;?></i> (<i class="fa fa-eur" aria-hidden="true"><?php echo $btc_received_worth;?></i>) have been or will be donated to Stichting leergeld Arnhem.<br />
<br />
Please note that the calculation above might be incorrect until there have been enough funds to properly test with!

<hr>
What is Stichting Leergeld Arnhem? and why do you give 75% of the donations to them?<br />
<br />
Stichting Leergeld Arnhem is a Charity based in Arnhem (The Netherlands).<br />
Here in The Netherlands a "stichting" is the same as a charity.<br />
Leergeld is a charity that helps children of which parents are having financial issues by paying (or helping to pay, it depends per household) the after-school activities like Judo, Soccer etc.<br />
Also, now that we are in the digital age, most stuff like homework is done trough computers, unfortunately, not every household can afford a computer, which is where leergeld comes in again!<br />
Leergeld is basically a charity that helps children that live in poverty to do their studies and still get most out of their youth.<br />
The reason that I give 75% of the donations to Hubble to Leergeld is because My mom and I have been helping out there,<br />
Well... My mom does waaaaay more than I do, but I help where I can.<br />
I've seen with my own eyes what great effort they pull of, and how enthusiastic the people are that help there.<br />
Which is why I chose that charity.<br />
I don't really trust big charities like KWF (a cancer research "charity"). why? because I saw that quite alot of the donations go towards the workers instead of the actual research.<br />
Leergeld isn't like that. all people that help out there are volunteers, and don't get paid for their work in money, they get paid in gratitude, which I think is more important than money.<br />


<hr>
How can we verify you won't run off with all the money?<br />
<br />
Why would I?<br />
The folks over at Leergeld have helped me out quite alot.<br />
They gave me some spare harddrives when one of mine broke down (nearly all harddrives that are in Sagan Server, and thus keep the data for all my projects came from there), or they gave me some old computerparts for my collection etc etc.<br />
Stealing stuff just isn't my style.