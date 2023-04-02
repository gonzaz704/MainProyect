<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class Image
{

    static $swaggerTypes = array(
        'fingerprint' => 'Fingerprint',
        'image_data' => 'array[byte]'

    );

    /**
     * The semantic fingerprint representation.
     */
    public $fingerprint; // Fingerprint
    /**
     * Image data in base64 encoding.
     */
    public $image_data; // array[byte]
}

