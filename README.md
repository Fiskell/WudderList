# WudderList
A Wunderlist CowSay integration

# Installation

```
composer install
```

Copy `.env.default` to `.env`

#Setting up Wunderlist .env

You will need to get a client id and an access token to fill in the .env

### Client ID

Navigate to `https://developer.wunderlist.com/apps/new`
This may require you to sign in.

Fill in the name and description with lyrics from your favorite Bieber song.

Then fill in:
```
    App URL => https://www.getpostman.com
    Auth Callback URL => https://www.getpostman.com/oauth2/callback
```

Once you hit save you now have your client id

### Access Token

run php wunder.php auth

You now have an access token ;)

###List all WunderList Lists
`./moo`

You will need to select the id of the list you would like to display

###Display the first position in the list
`./moo {list_id}`
