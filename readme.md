# EonX Test Task

This project is the code base of the PHP Test Task for the company [EonX][1]. 
It is based on a really simple version of [Laravel Lumen][2].

## Context
This test task requires you to implement a new feature into an existing RESTful API.

The API is built to interact with [MailChimp via their API][3], handling CRUD operations for [LISTS][4] and [MEMBERS][5].

This task assumes all interaction will take place via this API, therefore data should be stored locally and 
only retrieved from MailChimp when required. 

The current API contains code which allows the creation, retrieval, update and deletion of lists. 
You are required to add a feature to this existing code to allow the creation, retrieval update, and 
deletion of members within a list.

## Scope
The implementation for [LISTS][4] have been made already. The scope of this task is to update the current code base to
implement CRUD operations for members:

- Add members to a list
- Update members within a list
- Remove members from a list
- Retrieve members from a list

## Requirements
This task requirements are as follows:

- Each external libraries are loaded via [composer][9]
- The database layer used is [Doctrine][6] via the [laravel-doctrine/orm][7] package
- The interaction with [MailChimp API][3] is made using [pacely/mailchimp-apiv3][8]

## Get Started
- [Register on MailChimp][10], create your API key to use in your application

To complete this task you can either:
- Fork this repository, update the code base and send the URL of your repository to the reviewer(s)
- Clone this repository into your local environment, update the code base and send a zip of the repository to the reviewer(s)

[1]: https://eonx.com
[2]: https://lumen.laravel.com
[3]: http://developer.mailchimp.com/documentation/mailchimp/reference/overview
[4]: http://developer.mailchimp.com/documentation/mailchimp/reference/lists
[5]: http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members
[6]: http://www.doctrine-project.org/projects/orm.html
[7]: https://www.laraveldoctrine.org/docs/1.3/orm
[8]: https://github.com/pacely/mailchimp-api-v3
[9]: https://getcomposer.org/
[10]: https://login.mailchimp.com/signup/
