HOW TO ACCESS AND PLAY MY WEB GAME
BY MATTHEW LE NEPVEU

SETTING UP:
1. Download Wamp from the Internet (assuming your using Windows).
2. Follow instructions to install Wamp to the computer.
3. Copy the "loginsystem" folder from my submission to the installation files of Wamp and follow these folders: wamp64\bin\mysql\mysql5.7.26\data and copy it to the data folder.
4. Create an empty folder in the wamp64\www directory and call it "website".
4. Copy all the other files and folders EXCEPT the "loginsystem" folder and this readme into the empty "website" folder you created earlier.
5. Click the Wamp icon from the toolbar at the bottom right of screen and click phpMyAdmin.
6. Login with "root" the username and no password.
7. To run the website, type into your browser localhost/website and you can now use the website.

USING WEBSITE:
1. Click the signup button and signup by filling all fields in, which should be stored in the "users" table on the phpMyAdmin server.
2. Login using either your username or email and your password you used to signup with.
3. You should now have access to play Tic Tac Toe online.

PLAYING TIC TAC TOE:
1. Either press "Go" to allow computer to make their turn first, or input an "x" (must be lowercase) into one of the nine boxes and then press "Go" to submit your turn.
2. Alternate turns whilst you try and get three "x"s in a row.
3. Once the game ends, your User ID from the "users" table should be stored in the "games" table, along with how many games the user has played.
4. Press "Play Again" to play another game of "Tic Tac Toe", with each game you finish incrementing by one the number of games your User ID has played in the "games" table.
5. Once you are done playing Tic Tac Toe, press the "Logout" button in the header which should send you back to the home page.

Please let me know if you have any more questions/queries with how to access my website or use it :) 
