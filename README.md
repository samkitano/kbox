# Kickbox for Laravel

## [Kickbox](http://kickbox.io) is an Email Verification Library for PHP

According to [kickbox-php](github.com/kickboxio/kickbox-php):

	Kickbox determines if an email address is not only valid, but associated with a actual user. Uses include:

	* Preventing users from creating accounts on your applications using fake, misspelled, or throw-away email addresses.
	* Reducing bounces by removing old, invalid, and low quality email addresses from your mailing lists.
	* Saving money and projecting your reputation by only sending to real email users.

	## Getting Started

	To begin, hop over to [kickbox.io] and create a free account. Once you've signed up and logged in, click on **API Settings** and then click **Add API Key**. Take note of the generated API Key - you'll need it to setup the client as explained below.

	## Bug Reports
	Report [here](https://github.com/kickboxio/kickbox-php/issues).

	## Need Help?
	help@kickbox.io

## Installation

Add the following to your composer.json

```js
{
    "require": {
        "samkitano/kbox": "dev-master"
    }
}
```

Update your dependencies

```bash
$ php composer.phar update
```

Open `app/config/app.php`, and add a new item to the providers array:

	'Samkitano\Kbox\KboxServiceProvider',

Publish your configuration file:

	php artisan config:publish samkitano/kbox

Edit `app/config/packages/samkitano/kbox/config.php` and provide your API key:

	'kickbox_api_key'   => 'paste your kickbox api key here',

#### Versions

Works with Laravel [ 4.2 ]

## Usage

	$response = Kbox::verify('email@example.com');

### Response information (from kickbox.io)

A successful API call responds with the following values:

- **result** `string` - The verification result: `valid`, `invalid`, `unknown`
- **reason** `string` - The reason for the result. Possible reasons are:
  - `invalid_email` - Specified email is not a valid email address syntax
  - `invalid_domain` - Domain for email does not exist
  - `rejected_email` - Email address was rejected by the SMTP server, email address does not exist
  - `accepted_email` - Email address was accepted by the SMTP server
  - `no_connect` - Could not connect to SMTP server
  - `timeout` - SMTP session timed out
  - `invalid_smtp` - SMTP server returned an unexpected/invalid response
  - `unavailable_smtp` - SMTP server was unavailable to process our request
  - `unexpected_error` - An unexpected error has occurred
- **role**  `true | false` - *true* if the email address is a *role* address (`postmaster@example.com`, `support@example.com`, etc)
- **free**  `true | false` - *true* if the email address uses a free email service like gmail.com or yahoo.com.
- **disposable**  `true | false` - *true* if the email address uses a *disposable* domain like trashmail.com or mailinator.com.
- **accept_all**  `true | false` - *true* if the email was accepted, but the domain appears to accept all emails addressed to that domain.
- **did_you_mean** `null | string` - Returns a suggested email if a possible spelling error was detected. (`bill.lumbergh@gamil.com` -> `bill.lumbergh@gmail.com`)
- **sendex** `float` - A *quality* score of the provided email address ranging between 0 (no quality) and 1 (perfect quality). More information on the Sendex Score can be found [here](http://help.kickbox.io/support/solutions/articles/4000017047-the-sendex-).
- **email** `string` - Returns a normalized version of the provided email address. (`BoB@example.com` -> `bob@example.com`
- **user** `string` - The user (a.k.a local part) of the provided email address. (`bob@example.com` -> `bob`)
- **domain** `string` - The domain of the provided email address. (`bob@example.com` -> `example.com`)
- **success** `true | false` - *true* if the API request was successful (i.e., no authentication or unexpected errors occured)

## License
MIT
