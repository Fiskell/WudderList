# WudderList
Stay focused on your top wunderlist task by having a colorful rainbow cow blurt it out.

#Usage

###List all WunderList Lists
`./moo`

You will need to select the id of the list you would like to display

###Display the first position in the list
`./moo {list_id}`


# Installation

Install composer dependencies
```
composer install
```

Create the .env for your Wunderlist credentials
```
cp .env.default .env
```

Install cowsay
```
npm install -g cowsay
```

Install lolcat
```
gem install lolcat
```

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

This part kind of sucks, but we can get through this together.

Install postman: `https://www.getpostman.com/`

From there make a new request and click on the `Authorization` tab.

Next select `OAuth 2.0` and choose one of the radio buttons (doesn't matter)

Here fill in the following:
```
    Authorization URL: https://www.wunderlist.com/oauth/authorize
    Access Token URL: https://www.wunderlist.com/oauth/access_token
    Client ID: The client id from above
```
Hit get access token and it should ask you to log in, you will now have an access token.

Note: The token may be either in the url, or in the headers tab under `X-Access-Token`

Place your newly received token into your .env and get ready to celebrate

