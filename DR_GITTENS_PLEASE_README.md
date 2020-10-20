# Adv-Web-Dev-Frameworks-Assignment-1
Repository for Adv Web Dev Frameworks Assignments

Hi,

Please note:

1) When signing up a new user, you MUST add their email to the accessible array in SessionClass.php or you will be booted to the index page constantly. That goes for both the
   profile and courses association inside of the array (same as you have it originally). I'm going to add code to automatically add them to a json file which will handle access
   of users and pull that on creation of a SessionClass object and store it in the accessible array in the future to avoid hard-coding the emails into the array every time a new 
   user is added.
2) The way the user_courses file is set up, along with the function to display user specific courses on profile.php, only requires you to enter an array of courseIDs, indexed by
   the name courseID (there are some in there already, so simply copy the json format) within the user_courses.json file. If you don't, nothing will come up except 3 warnings 
   (Didn't have a chance to error catch users with no courses, will do it in the future).
