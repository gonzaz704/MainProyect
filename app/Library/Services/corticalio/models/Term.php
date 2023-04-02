<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class Term
{

    static $swaggerTypes = array(
        'fingerprint' => 'Fingerprint',
        'df' => 'float',
        'pos_types' => 'array[string]',
        'score' => 'float',
        'term' => 'string'

    );

    /**
     * The Fingerprint of this term.
     */
    public $fingerprint; // Fingerprint
    /**
     * The df value of this term.
     */
    public $df; // float
    /**
     * The pos types of the term.
     */
    public $pos_types; // array[string]
    /**
     * The score of this term.
     */
    public $score; // float
    /**
     * The term as a string.
     */
    public $term; // string
}

