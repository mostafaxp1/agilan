# Introduction #

**Architectural specs corresponding/mapped to high-level specs.**

# Overall #
  * It's web based
  * thick/thin client
  * built-in multithreading
  * expose a set of functions as an API ?
  * utilize external API ?
  * layers loosely coupled to promote Soc (separation of concerns).
  * features are plugin or module based. so that, other developers can easily extend as per their needs.

# Details #

## Users ##
  * user table will be referenced from other entity models e.g. bookmarks, status updates, files, blog pages, temp chat messages etc.

## Tables ##
  * Some tables we may consider (user acconts, permissions, user profiles, privacy, alerts, friends, frnd invitations, status updates, messages, recipients, files, file types, blogs, posts, groups, grp type, grp members, comments, tags, ratings)

## Other Requirements ##

**Status Updates**
  * comments/response in 1 level of threads

**Bookmarks**
  * pulling/extracting url info. using cURL ?

**Blogging**
  * We may utilize [this](http://www.open-blog.info/)

**File Sharing**
  * We may utilize [this](http://net.tutsplus.com/tutorials/php/creating-a-file-hosting-site-with-codeigniter/)

**Wiki**
  * (wiki)

## Other Enhancements (Future) ##

### Optional Uncensored Features ###
**Online Chatting**
  * We may utilize [this](https://blueimp.net/ajax/)

**Content Rating**
  * (coming)

**Meeting Tracking**
  * Need to maintain an Employee-Manager relationships(so, user table will have to have a nullable Manager-ID attribute). Employees will be notified upon Manager announced a meeting time, users, room etc.

**Web Analytics/Stats**
  * We may utilize [this](http://piwik.org/)  (pagerank 10 on 10)



---


# THOUGHTS ON TABLES #
My original thought was to have it be internal only, no outsiders yet. That's a pretty good thought to have the ability to share with customers and vendors, though--I like it. Maybe for a later version? That way we can do away with groups, permissions, privacy, etc.

Some other thoughts on nomenclature:

  * all field names are lower case
  * use _between words
  * use id as primary field name
  * fk id is description\_id (like user\_id to point to users table)_


The friends thing can be handled with the follows table. You simply track who the follower\_id is, and who the following\_id is, and you can keep track of each other's status updates. This is already set up and coded, I just need to test with multiple users.

Alerts/notifications...yeah, we're going to need this, big time. People have to know when someone has put up a file, blogged, whatever. Actually the best way to handle this is to have whatever it is you are doing actually show up in your status updates. That way if you are following someone, you see what they are up to. Perfect.

My other idea was to use tags to be able to follow different content--I'm not sure if we should have a centralized table for tags and then use mapping tables to point at the different content types (such as blogs, media files, etc) or whether it will be okay to just have a tags field in each of the different tables. Probably the former is best and will keep us from going mad. But the latter is easier for now.

Private messaging can be handled really simply. One table:
```
id
from_id (fk to users)
to_id (fk to users)
subject
message
created
location (inbox/sent/archive)
```

No folders on messages, they are either in your inbox, your sent messages, or an archive.


On media galleries, no folders, we'll use tags to keep track of how they are organized. We can keep track of other metadata as needed:

```
id
user_id
title
description
location
file_type
file_size
created
tags
```

It occurs to me just now that the photos for the users table is probably best handled as a photo\_id -- an fk to the media table. Hmmmmmmmmm.

I don't have any ideas on wikis, and I think we should probably move forward on using open blog as an integration point.

Remember, the goal is to be able to actually have something working by the time I get to Holland in October. When we show it to them, they can join us and we can rev it to version whatever. :)





# **TABLES WITH COLUMNS** #

**omit the colors**

```
[users]
Accounts (pk_AccountID,fk1_TermID,fk2_ManagerAccountID[nullable], FirstName,LastName,Email,EmailVerified,zip,Username,Password,BirthDate,CreateDate,LastUpdateDate,Timestamp,AgreedToTermsDate)
Permissions (pk_PermissionID, Name,Timestamp)
AccountPermissions (pk_apid,fk1_AccountID,fk2_PermissionID, Timestamp)
Terms (pk_TermID, Terms,CreateDate,TimeStamp)



[user profiles]
The Profiles tables
Profiles (pk_ProfileID,fk_AccountID, ProfileName[char,nullable],CreateDate[datetime,nullable],LastUpdateDate[datetime,nullable],LevelOfExperienceTypeID,IMMSN,IMAOL,IMGIM,IMYIM,IMICQ,IMSkype,Signature,Timestamp,Avatar[binary,nullable],AvatarMimeType[char,nullable])
ProfileAttributes (pk_ProfileAttributeID,fk1_ProfileID,fk2_ProfileAttributeTypeID, Response[char],CreateDate,TimeStamp)
ProfileAttributeTypes (pk_ProfileAttributeTypeID,fk_PrivacyFlagTypeID, AttributeType[char],SortOrder[int])
LevelOfExperienceType (pk_LevelOfExperienceTypeID, LevelOfExperience[char],TimeStamp,SortOrder[int])

The Privacy tables
PrivacyFlagTypes (pk_PrivacyFlagTypeID, FieldName,TimeStamp,SortOrder)
VisibilityLevels (pk_VisibilityLevelID, Name)
PrivacyFlags (pk_PrivacyFlagID,fk1_PrivacyFlagTypeID,fk2_ProfileID,fk3_VisibilityLevelID, CreateDate,TimeStamp)

The Alerts tables
AlertTypes (pk_AlertTypeID, Name)
Alerts (pk_AlertID,fk1_AlertTypeID,fk2_AccountID, CreateDate,IsHidden,Message,TimeStamp)




[friends]
Friends (pk_FriendID,fk1_AccountID,fk2_MyFriendsAccountID, CreateDate,TimeStamp)
FriendInvitations (pk_InvitationID,fk1_AccountID,fk2_BecameAccountId, Email,UniqueID[guid],CreateDate,TimeStamp)
StatusUpdates (pk_StatusUpdateID,fk_AccountID, Status,CreateDate,TimeStamp)



[messaging]
Messages (pk_MessageID,fk1_SentByAccountID,fk2_MessageTypeID, Subject,Body,CreateDate,TimeStamp)
MessageTypes (pk_MessageTypeID, Name,TimeStamp)
MessageRecipients (pk_MessageRecipientID,fk1_MessageID,fk2_MessageRecipientTypeID,fk3_AccountID,fk4_MessageFolderID,fk5_MessageStatusTypeID, TimeStamp)
MessageRecipientTypes (pk_MessageRecipientTypeID, Name)
MessageStatusTypes (pk_MessageStatusTypeID, Name,TimeStamp)
MessageFolders (pk_MessageFolderID,fk_AccountID, FolderName,IsSystem,TimeStamp)



[media galleries]
Files (pk_FileID,fk1_FileSystemFolderID,fk2_FileTypeID,fk3_AccountID,fk4_DefaultFolderID, FileSystemName,FileName,CreateDate,IsPublicResource[bit],Description,TimeStamp,Size[int])
FileSystemFolders (pd_FileSystemFolderID, Path,TimeStamp)  
FileTypes (pk_FileTypeID, Name)  
Folders (pk_FolderID,fk1_AccountID,fk2_FolderTypeID, Name,IsPublicResource,CreateDate,Description,Location,TimeStamp)
FolderTypes (pk_FolderTypeID, Name)  
AccountFolders (fk1_AccountID,fk2_FolderID, TimeStamp)  
AccountFiles (fk1_AccountID,fk2_FileID, TimeStamp)  
FolderFiles (fk1_FolderID,fk2_FileID,fk3_AccountID, CreateDate,TimeStamp)



[blogs]
Blogs (pk_BlogID,fk1_AccountID, Title,Subject,Post,CreateDate,UpdateDate,IsPublished,PageName)



[message boards]
BoardCategories (pk_CategoryID,fk1_LastPostByAccountID,fk2_LastPostByUsername, Name,Subject,SortOrder,TimeStamp,CreateDate,UpdateDate,ThreadCount,PostCount,LastPostDate,PageName)
BoardForums (pk_ForumID,fk1_CategoryID, LastPostByAccountID,LastPostByUserName, Name,Subject,ThreadCount,PostCount,CreateDate,UpdateDate,LastPostDate,TimeStamp,PageName)
BoardPosts (pk_PostID,fk1_AccountID,fk2_ForumID,fk3_ThreadID, UserName,ReplyByAccountID,ReplyByUsername, IsThread,Name,Post,CreateDate,UpdateDate)



[groups]
Groups (pk_GroupID,fk1_AccountID, FileID, Name,CreateDate,UpdateDate,MemberCount,PageName,Description,TimeStamp,IsPublic,Body)
GroupMembers (pk_ID,fk1_GroupID,fk2_AccountID, CreateDate,TimeStamp,IsAdmin,IsApproved)
GroupTypes (pk_GroupTypeID, Name,TimeStamp)
GroupToGroupTypes (pk_ID,fk1_GroupID,fk2_GroupTypeID, TimeStamp)
GroupForums (pk_ID,fk1_GroupID,fk2_ForumID,CreateDate,TimeStamp)



[comments, tags, ratings]
SystemObjects (pk_SystemObjectID, TimeStamp,Name)
Ratings (pk_RatingID,fk1_CreatedByAccountID,fk2_SystemObjectID,fk3_SystemObjectRatingOptionID, Score,CreatedByUsername,TimeStamp,CreateDate,SystemObjectRecordID)
SystemObjectRatingOptions (pk_SystemObjectRatingOptionID,fk_SystemObjectID, Name,Description,TimeStamp)
Tags (pk_TagID, Name,Count,TimeStamp,CreateDate)  
SystemObjectTags (pk_SystemObjectTagID,fk1_SystemObjectID,fk2_CreatedByAccountID,fk3_TagID, TimeStamp,SystemObjectRecordID,CreateDate,CreatedByUsername)
Comments (pk_CommentID,fk1_CommentsByAccountID,fk2_SystemObjectID, TimeStamp,Body,CreateDate,CommentsByUsername,SystemObjectRecordID)


[filtering]
ContentFilters (pk_ContentFilterID,fk_AccountID, StringToFilter,ReplaceWith,CreateDate,TimeStamp)


```