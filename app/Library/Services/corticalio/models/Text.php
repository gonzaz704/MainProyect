<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class Text
{

    static $swaggerTypes = array(
        'text' => 'string',
        'fingerprint' => 'Fingerprint'

    );

    /**
     * The text as a string
     */
    public $text; // string
    /**
     * The semantic fingerprint representation of the text.
     */
    public $fingerprint; // Fingerprint
}

