<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class CategoryFilter {

  static $swaggerTypes = array(
      'categoryName' => 'string',
      'positions' => 'array[int]'

    );

  /**
  * The descriptive label for a CategoryFilter name
  */
  public $categoryName; // string
  /**
  * The positions of a Fingerprint
  */
  public $positions; // array[int]
  }

