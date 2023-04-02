<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class Context
{
    static $swaggerTypes = array(
        'fingerprint' => 'Fingerprint',
        'context_label' => 'string',
        'context_id' => 'int'

    );

    /**
     * The semantic fingerprint representation of a context
     */
    public $fingerprint; // Fingerprint
    /**
     * The descriptive label of a context.
     */
    public $context_label; // string
    /**
     * The id of a context.
     */
    public $context_id; // int
}

