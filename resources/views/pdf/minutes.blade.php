<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
<!--
span.cls_004{font-family:Arial,serif;font-size:42.0px;color:rgb(105,92,69);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_004{font-family:Arial,serif;font-size:42.0px;color:rgb(105,92,69);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_005{font-family:Arial,serif;font-size:14.0px;color:rgb(105,92,69);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_005{font-family:Arial,serif;font-size:14.0px;color:rgb(105,92,69);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_006{font-family:Courier New,serif;font-size:18.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_006{font-family:Courier New,serif;font-size:18.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_007{font-family:Arial,serif;font-size:16.0px;color:rgb(0,133,116);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_007{font-family:Arial,serif;font-size:16.0px;color:rgb(0,133,116);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_008{font-family:Arial,serif;font-size:18.1px;color:rgb(255,93,13);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_008{font-family:Arial,serif;font-size:18.1px;color:rgb(255,93,13);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_002{font-family:Arial,serif;font-size:11.0px;color:rgb(105,92,69);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_002{font-family:Arial,serif;font-size:11.0px;color:rgb(105,92,69);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_009{font-family:Arial,serif;font-size:14.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_009{font-family:Arial,serif;font-size:14.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
-->
</style>
<script type="text/javascript" src="8a079c28-4a33-11e9-9d71-0cc47a792c0a_id_8a079c28-4a33-11e9-9d71-0cc47a792c0a_files/wz_jsgraphics.js"></script>
</head>
<body>
<div style="position:absolute;left:50%;margin-left:-306px;top:0px;width:612px;height:792px;border-style:outset;overflow:hidden">
<div style="position:absolute;left:0px;top:0px">
<img src="{{assets(images/pdf/background1.jpg)}}" width=612 height=792></div>
<div style="position:absolute;left:72.00px;top:408.75px" class="cls_004"><span class="cls_004">{{ $generalData['name']}}</span></div>
<div style="position:absolute;left:72.00px;top:470.51px" class="cls_005"><span class="cls_005">{{ $meeting->name }}</span></div>
<div style="position:absolute;left:72.00px;top:487.50px" class="cls_006"><span class="cls_006">─</span></div>
<div style="position:absolute;left:72.00px;top:585.50px" class="cls_007"><span class="cls_007">Presided By</span></div>
<div style="position:absolute;left:72.00px;top:605.51px" class="cls_005"><span class="cls_005">{{ $meeting->presider()->first()->firstname}} {{ $meeting->presider()->first()->lastname}}</span></div>
/* <div style="position:absolute;left:72.00px;top:649.50px" class="cls_008"><span class="cls_008">Overview</span></div>
<div style="position:absolute;left:72.00px;top:683.51px" class="cls_002"><span class="cls_002">The initial design for the society management application revolved around an email</span></div>
<div style="position:absolute;left:72.00px;top:699.26px" class="cls_002"><span class="cls_002">scheduler for society reports. However, I came to a “light bulb” moment, realizing that the</span></div> */
</div>
<div style="position:absolute;left:50%;margin-left:-306px;top:802px;width:612px;height:792px;border-style:outset;overflow:hidden">
<div style="position:absolute;left:0px;top:0px">
<img src="{{ assets(images/pdf/background2.jpg) }}" width=612 height=792></div>
<div style="position:absolute;left:533.18px;top:34.76px" class="cls_009"><span class="cls_009">1</span></div>
<div style="position:absolute;left:72.00px;top:88.00px" class="cls_002"><span class="cls_002">{!! $meeting->minute !!}</span></div>
/* <div style="position:absolute;left:72.00px;top:103.75px" class="cls_002"><span class="cls_002">society, association or a club.</span></div>
<div style="position:absolute;left:72.00px;top:143.25px" class="cls_008"><span class="cls_008">Goals</span></div>
<div style="position:absolute;left:90.00px;top:177.26px" class="cls_002"><span class="cls_002">1.  Create a functional, usable society management application with laravel or flask, in</span></div>
<div style="position:absolute;left:108.00px;top:193.01px" class="cls_002"><span class="cls_002">the process, learning more about building effective (fresh) software architectures.</span></div>
<div style="position:absolute;left:90.00px;top:214.76px" class="cls_002"><span class="cls_002">2.  Scaling the application to be used and adopted by at least three societies/club</span></div>
<div style="position:absolute;left:90.00px;top:236.51px" class="cls_002"><span class="cls_002">3.  Hopefully monetize the application if it becomes a utility</span></div>
<div style="position:absolute;left:72.00px;top:276.00px" class="cls_008"><span class="cls_008">Product Scope/Specifications</span></div>
<div style="position:absolute;left:72.00px;top:310.01px" class="cls_002"><span class="cls_002">These are the application modules I currently scope. It can be added upon or improved.</span></div>
<div style="position:absolute;left:72.00px;top:331.76px" class="cls_002"><span class="cls_002">All Instances are mapped to how a society/association operates in real life.</span></div>
<div style="position:absolute;left:72.00px;top:363.50px" class="cls_007"><span class="cls_007">Members/Contact Module</span></div>
<div style="position:absolute;left:72.00px;top:388.76px" class="cls_002"><span class="cls_002">A user of the application is tied to a society(tenant)</span></div>
<div style="position:absolute;left:72.00px;top:410.51px" class="cls_002"><span class="cls_002">A user can belong to multiple societies.</span></div>
<div style="position:absolute;left:72.00px;top:432.26px" class="cls_002"><span class="cls_002">A user must have at least one role. The default being “Floor Member”.</span></div>
<div style="position:absolute;left:72.00px;top:454.01px" class="cls_002"><span class="cls_002">A user can create members or add members to his/her society.</span></div>
<div style="position:absolute;left:72.00px;top:475.76px" class="cls_002"><span class="cls_002">A user can view all members in his/her society</span></div>
<div style="position:absolute;left:72.00px;top:497.51px" class="cls_002"><span class="cls_002">The application can compute the user activity score, which would result from his/her</span></div>
<div style="position:absolute;left:72.00px;top:513.26px" class="cls_002"><span class="cls_002">average meeting attendance and society due payments.</span></div>
<div style="position:absolute;left:72.00px;top:535.01px" class="cls_002"><span class="cls_002">A committee can be created. A user can belong to different committees.</span></div>
<div style="position:absolute;left:72.00px;top:556.76px" class="cls_002"><span class="cls_002">The application can retrieve all executives of the society, which is tied to a role.</span></div>
<div style="position:absolute;left:72.00px;top:610.25px" class="cls_007"><span class="cls_007">Meeting Modudle</span></div>
<div style="position:absolute;left:72.00px;top:635.51px" class="cls_002"><span class="cls_002">The application would be used to record meetings.</span></div>
<div style="position:absolute;left:72.00px;top:657.26px" class="cls_002"><span class="cls_002">A minute can be created read, shared and saved. A minute is tied to a meeting.</span></div>
<div style="position:absolute;left:72.00px;top:679.01px" class="cls_002"><span class="cls_002">Any member can search for minutes and meeting specifics.</span></div>
<div style="position:absolute;left:72.00px;top:700.76px" class="cls_002"><span class="cls_002">The application can be used to record  “matters arising.”</span></div> */
</div>
/* <div style="position:absolute;left:50%;margin-left:-306px;top:1604px;width:612px;height:792px;border-style:outset;overflow:hidden">
<div style="position:absolute;left:0px;top:0px">
<img src="{{ assets(images/pdf/background3.jpg) }}" width=612 height=792></div>
<div style="position:absolute;left:533.18px;top:34.76px" class="cls_009"><span class="cls_009">2</span></div>
<div style="position:absolute;left:72.00px;top:94.00px" class="cls_002"><span class="cls_002">Matters Arising are independent of meetings.</span></div>
<div style="position:absolute;left:72.00px;top:115.75px" class="cls_002"><span class="cls_002">Matters arising can be marked as resolved.</span></div>
<div style="position:absolute;left:72.00px;top:137.51px" class="cls_002"><span class="cls_002">Reports can be recorded, shared, searched for and saved.</span></div>
<div style="position:absolute;left:72.00px;top:159.26px" class="cls_002"><span class="cls_002">Reports are independent of meetings but can be tied to a commitee or an individual</span></div>
<div style="position:absolute;left:72.00px;top:175.01px" class="cls_002"><span class="cls_002">member.</span></div>
<div style="position:absolute;left:72.00px;top:196.76px" class="cls_002"><span class="cls_002">Tasks can be created and assigned to a member. Tasks can be related to a specific Matters</span></div>
<div style="position:absolute;left:72.00px;top:212.51px" class="cls_002"><span class="cls_002">Arising. Tasks are independent of meetings.</span></div>
<div style="position:absolute;left:72.00px;top:234.26px" class="cls_002"><span class="cls_002">A collection can be recorded and tied to a meeting.</span></div>
<div style="position:absolute;left:72.00px;top:256.01px" class="cls_002"><span class="cls_002">A collection can be either, dues, levy, donation or expenses. A collection is made by a</span></div>
<div style="position:absolute;left:72.00px;top:271.76px" class="cls_002"><span class="cls_002">member and recorded/approved by another member/executive.</span></div>
<div style="position:absolute;left:72.00px;top:293.51px" class="cls_002"><span class="cls_002">Attendance can be taken for a meeting. Attendance are tied to a meeting and does not</span></div>
<div style="position:absolute;left:72.00px;top:309.26px" class="cls_002"><span class="cls_002">exist on its own. User can search and view attendance information of members.</span></div>
<div style="position:absolute;left:72.00px;top:362.75px" class="cls_007"><span class="cls_007">Finance Module</span></div>
<div style="position:absolute;left:72.00px;top:388.01px" class="cls_002"><span class="cls_002">User can view all dues paid by members.</span></div>
<div style="position:absolute;left:72.00px;top:409.76px" class="cls_002"><span class="cls_002">User can view defaults of dues/levy/pledges.</span></div>
<div style="position:absolute;left:72.00px;top:431.51px" class="cls_002"><span class="cls_002">The application can calculate total revenue generated by the society from dues, donations</span></div>
<div style="position:absolute;left:72.00px;top:447.26px" class="cls_002"><span class="cls_002">and other forms of generated revenue.</span></div>
<div style="position:absolute;left:72.00px;top:469.01px" class="cls_002"><span class="cls_002">User can record expenses made on behalf of the society</span></div>
<div style="position:absolute;left:72.00px;top:522.50px" class="cls_007"><span class="cls_007">Messenger Module</span></div>
<div style="position:absolute;left:72.00px;top:547.76px" class="cls_002"><span class="cls_002">This is a central part of the application. As this relies on inputted member/society</span></div>
<div style="position:absolute;left:72.00px;top:563.51px" class="cls_002"><span class="cls_002">information to perform automated messaging actions.</span></div>
<div style="position:absolute;left:72.00px;top:585.26px" class="cls_002"><span class="cls_002">The application can automatically send birthday messages via email to members.</span></div>
<div style="position:absolute;left:72.00px;top:607.01px" class="cls_002"><span class="cls_002">The application can send reminders for meetings.</span></div>
<div style="position:absolute;left:72.00px;top:628.76px" class="cls_002"><span class="cls_002">The application can send reports on intervals as specified by the user.</span></div>
<div style="position:absolute;left:72.00px;top:650.51px" class="cls_002"><span class="cls_002">The application can send task notification when assigned and as a reminder.</span></div>
<div style="position:absolute;left:72.00px;top:672.26px" class="cls_002"><span class="cls_002">The application can send notification for societal dues/levys/pledges.</span></div>
<div style="position:absolute;left:72.00px;top:694.01px" class="cls_002"><span class="cls_002">The application can trigger messages when member attendance is low or members activity</span></div>
<div style="position:absolute;left:72.00px;top:709.76px" class="cls_002"><span class="cls_002">score goes below a certain threshold.</span></div>
</div>
<div style="position:absolute;left:50%;margin-left:-306px;top:2406px;width:612px;height:792px;border-style:outset;overflow:hidden">
<div style="position:absolute;left:0px;top:0px">
<img src="{{ assets(images/pdf/background4.jpg) }}" width=612 height=792></div>
<div style="position:absolute;left:533.18px;top:34.76px" class="cls_009"><span class="cls_009">3</span></div>
<div style="position:absolute;left:72.00px;top:94.00px" class="cls_002"><span class="cls_002">The application can send out registration links and welcome messages/onboarding to new</span></div>
<div style="position:absolute;left:72.00px;top:109.75px" class="cls_002"><span class="cls_002">members.</span></div>
<div style="position:absolute;left:72.00px;top:153.26px" class="cls_002"><span class="cls_002">Other trivial scopes, include user account profile,</span></div>
<div style="position:absolute;left:72.00px;top:175.01px" class="cls_002"><span class="cls_002">Statement of society financial position.</span></div>
<div style="position:absolute;left:72.00px;top:236.25px" class="cls_008"><span class="cls_008">Milestones</span></div>
<div style="position:absolute;left:83.41px;top:280.25px" class="cls_007"><span class="cls_007">I.</span></div>
<div style="position:absolute;left:108.00px;top:280.25px" class="cls_007"><span class="cls_007">Frontend/Backend Implementation</span></div>
<div style="position:absolute;left:108.00px;top:305.51px" class="cls_002"><span class="cls_002">Build the first version of the application with the simplest features to be used by the</span></div>
<div style="position:absolute;left:108.00px;top:321.26px" class="cls_002"><span class="cls_002">test society. Deadline: 31st March, 2019.</span></div>
</div> */

</body>
</html>