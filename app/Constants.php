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

     const COLLECTION_DUE_TYPE = "due";

     const COLLECTION_LEVY_TYPE = "levy";

     const COLLECTION_DONATION_TYPE = "donation";

     const COLLECTION_EXPENSE_TYPE = "expense";

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

    const COLLECTION_TYPES = [
        self::COLLECTION_DUE_TYPE,
        self::COLLECTION_LEVY_TYPE,
        self::COLLECTION_DONATION_TYPE,
        self::COLLECTION_EXPENSE_TYPE
    ];

    const DEFAULT_LIMIT = 10;

    const DEFAULT_PASSWORD = "123456";
 }