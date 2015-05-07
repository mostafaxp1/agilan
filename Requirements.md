# Introduction #

Most of these have come from the blog at http://myerman.posterous.com

# Details #

## Users ##
  * Users should be able to register and add info about themselves.
  * This info includes name, phone, email, username, short bio, photo, tags for expertise.
  * PHOTO STILL ON TODO LIST
  * Users should be able to update everything but username and email.

## Other Requirements ##

**Status Updates**
  * post facebook-like statuses and see responses in threaded view (1 level of threading)
  * they should be able to "friend" other employees
  * they should also be able to see "all" employees in separate tab if they want
  * they should also be able to search employee status updates

**Bookmarks**
  * employees should be able to enter a URL
  * system can pull in a title or image (optional)
  * employee adds tags and privacy level (self, "friends", all employees)
  * employees can subscribe to a user's bookmarks, or bookmark tags

**Blogging**
  * employees should be able to create blog posts
  * employees should be able to comment on their own and other's posts
  * employees should be able to tag their blog posts
  * employees should be able to "subscribe" to posts by people or by tag

**File Sharing**
  * employees should be able to post files and then tag them
  * files can be private, viewable by "friends" or by all (default is all)
  * employees should be able to keep track of files posted by user or tag
  * this is big enough to warrant some kind of code reuse or CI library

**Wiki**
  * all employees can create a wiki
  * they can assign privileges to others to work on their wiki
  * I think we can probably reuse an existing library for this???

## Other Enhancements (Future) ##

**Optional Uncensored Features**
  * online chatting
  * content rating
  * meeting tracking
  * web analytics