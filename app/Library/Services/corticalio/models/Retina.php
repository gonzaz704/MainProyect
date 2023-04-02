<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class Retina
{

    static $swaggerTypes = array(
        'retinaName' => 'string',
        'numberOfTermsInRetina' => 'int',
        'numberOfRows' => 'int',
        'numberOfColumns' => 'int',
        'description' => 'string'

    );

    /**
     * The identifier of a specific retina
     */
    public $retinaName; // string
    /**
     * The number of terms contained in a specific retina
     */
    public $numberOfTermsInRetina; // int
    /**
     * Number of rows of the fingerprints
     */
    public $numberOfRows; // int
    /**
     * Number of columns of the fingerprints
     */
    public $numberOfColumns; // int
    /**
     * The description of a specific retina
     */
    public $description; // string
}

