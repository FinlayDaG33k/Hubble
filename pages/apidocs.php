<h2>This Page is still a work in progress! information may not be correct or missing!</h2>

<p>
Hubble has it's own simple API.<br />
with this API, you get a JSON formatted output in which you can see the server status of your API key.<br />
An example:<br />
going to <a href="https://hubble.finlaydag33k.nl/api/?authkey=6qNofugsC34OJr3ZaeJ5xqL34RNbOIvV8jkoOBQqEVeominxx6D4xo8BgVN4Ej0M">https://hubble.finlaydag33k.nl/api/?authkey=6qNofugsC34OJr3ZaeJ5xqL34RNbOIvV8jkoOBQqEVeominxx6D4xo8BgVN4Ej0M</a>
results in the JSON output of:<br />
<br />
<code>
{"username":"finlaydag33k","servers":{"total":9,"offline":0,"servers":[{"name":"Kandicraft Website","IP":"kandicraft.finlaydag33k.nl","port":"80","status":"1","last_check":"17-04-16 11:50:01","last_error":""},{"name":"FinlayDaG33k Webblog","IP":"www.finlaydag33k.nl","port":"80","status":"1","last_check":"17-04-16 11:50:01","last_error":""},{"name":"Kandicraft Factions","IP":"kandicraft-factions.local","port":"25565","status":"1","last_check":"17-04-16 11:50:01","last_error":""},{"name":"Kandicraft Hub","IP":"kandicraft-hub.local","port":"25565","status":"1","last_check":"17-04-16 11:50:01","last_error":""},{"name":"Kandicraft UltraHardcore","IP":"kandicraft-uhc.local","port":"25565","status":"1","last_check":"17-04-16 11:50:01","last_error":""},{"name":"PhpMyAdmin","IP":"phpmyadmin.local","port":"80","status":"1","last_check":"17-04-16 11:50:01","last_error":""},{"name":"Kandicraft Bungeecord","IP":"kandicraft-bungeecord.local","port":"25565","status":"1","last_check":"17-04-16 11:50:01","last_error":""},{"name":"Hawking-Server","IP":"hawking.local","port":"8006","status":"1","last_check":"17-04-16 11:50:01","last_error":""},{"name":"Kasparov-Server","IP":"kasparov.local","port":"8006","status":"1","last_check":"17-04-16 11:50:01","last_error":""}]}}
</code><br />
<br />

This JSON output can then be parsed in apps, so that it can for example notify you when your server is unreachable.<br />
At the time of writing this, there is no official app available, and it's not in development.