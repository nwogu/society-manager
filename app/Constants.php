<?php

/**
 * @author Gabriel Nwogu <nwogugabriel@gmail.com>
 */

 namespace App;

 class Constants
 {
     const DEFAULT_ROLE = "Floor Member";
     
     const MATTERS_ARISING = "arising";

     const MATTERS_TREATING = "treating";

     const MATTERS_RESOLVED = "resolved";

     const MEETING_TYPE_GENERAL = "general meeting";
     
     const MEETING_TYPE_EXECUTIVE = "executive meeting";

     const MEETING_TYPE_COMMITEE = "commitee meeting";

     const REPORTER_COMMITEE_TYPE = "commitee";

     const REPORTER_MEMBER_TYPE = "member";

     const MEETING_TYPES = [
        self::MEETING_TYPE_GENERAL, 
        self::MEETING_TYPE_EXECUTIVE, 
        self::MEETING_TYPE_COMMITEE
    ];

    const MATTERS_STATUS = [
        self::MATTERS_ARISING,
        self::MATTERS_TREATING,
        self::MATTERS_RESOLVED
    ];

    const REPORTER_TYPES = [
        self::REPORTER_COMMITEE_TYPE,
        self::REPORTER_MEMBER_TYPE
    ];
 }