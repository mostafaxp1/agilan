# Introduction #

Agilan is a CodeIgniter-based open source social networking platform. I chose the name because it means "agile" in Croatian. I don't have any particular affinity to Croatia (other than a very good friend of mine!) but I like the idea that companies can use this software to become more agile--decide faster, change faster, react faster.

Target audience for this software are small businesses that need facebook/linkedin/twitter type functionality inside their own businesses. I plan to use it in my social intranet consulting--you are free to repackage/resell/rewhatever, and doubly so if you contribute to the project.

By the way, I'll be talking about this project at EECI 2009 in Holland this October....

  * [Follow me on Twitter!](http://www.twitter.com/myerman)
  * [Check out my blog!](http://myerman.posterous.com)
  * [Check out the requirements!](Requirements.md)

# Some Caveats For Contributors/Users #

As with all things CodeIgniter, you need to pay special attention to the content inside the /system/application folder. The config folder in particular will contain some files that you will need to pay attention to:

  * database.php will contain your local database connection strings
  * config.php will contain your local dev server setup strings
  * autoload.php will contain helpers/libraries/models and such that we autoload in the project

Individual developers will obviously need to make changes to database.php and config.php to match their own environments.

For this reason, please don't recommit your local database.php and config.php files! Just in case, keep a local copy that's separate from your subversion working copy, just in case somebody else's comes along and knocks you out.

Other things:

  * If you add a model, please add (in the comments!) a SQL statement for creating the table that goes with that model so we can create our own tables. MySQL only thanks.

  * I'm not prepared to deal with views at the moment--I just ginned up some basic stuff and put it in a master view called template.php that is reused throughout the project. You'll notice that the CSS is right there in the head. That's good enough for now--we can fix it later.

  * When users are first created, I use CI to autogenerate an 8 character password (alphas and numbers) then use md5() to create a 32-character hash that then goes into the users.password field. This is good enough for now, but we'll probably need to revisit as we work.

  * Likewise, I'm using a simple check of a SESSION variable to allow logins. We can replace with some other authentication protocol later.

  * I've decided to make full use of the ActiveRecord CI stuff in my models--at least, I'm planning on using it as much as I can. Much simpler that way, and gives us a bit of code portability.

  * I've also decided to use all lowercase names for functions, with underscores in between words. So, I'm using verify\_user() instead of verifyUser() or VerifyUser() or _verifyuser(). I may change my mind later, but at least for now I'll try to be consistent!_

## One More Thing ##
This project will not involve any messing around with the CI core classes. If you want to extend functionality, write a helper/library/hook. Period, end of story. We just can't go down that road! :)