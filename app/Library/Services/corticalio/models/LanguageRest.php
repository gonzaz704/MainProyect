<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/


class LanguageRest {

  static $swaggerTypes = array(
      'language' => 'string',
      'iso_tag' => 'string',
      'wiki_url' => 'string'

    );

  /**
  * Language
  */
  public $language; // string
  /**
  * ISO tag
  */
  public $iso_tag; // string
  /**
  * Get Wiki URL
  */
  public $wiki_url; // string
  }

