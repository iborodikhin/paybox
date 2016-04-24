<?php
namespace Paybox\Response;

use Paybox\Entity;
use Paybox\Exception\Error\Base as BaseError;
use Paybox\Exception\Reject;

/**
 * Base response class.
 */
abstract class Base extends Entity
{
    /**
     * Responsse types.
     */
    const TYPE_XML = 'xml';
    const TYPE_JSON = 'json';

    /**
     * Statuses.
     */
    const STATUS_PARTIAL = 'partial';
    const STATUS_PENDING = 'pending';
    const STATUS_OK = 'ok';
    const STATUS_FAILED = 'failed';
    const STATUS_REVOKED = 'revoked';

    /**
     * Errors.
     */
    const ERROR_NONE = 0;
    const ERROR_UNKNOWN = 1;
    const ERROR_GENERAL = 2;
    const ERROR_PAYMENT_SYSTEM = 3;
    const ERROR_ISSUING_INVOICE = 4;
    const ERROR_INCORRECT_REQUEST = 5;
    const ERROR_LIMIT_EXCEEDED = 40;
    const ERROR_PAYMENT_CANCELED = 50;
    const ERROR_CUSTOMER_DATA = 100;
    const ERROR_PHONE_NUMBER = 101;
    const ERROR_INCORRECT_TRANSACTION = 300;
    const ERROR_INCORRECT_CARD_NUMBER = 301;
    const ERROR_INCORRECT_CARD_HOLDER_NAME = 302;
    const ERROR_INCORRECT_CARD_CVV2_CVC2 = 303;
    const ERROR_INCORRECT_CARD_VALIDITY_DATE = 304;
    const ERROR_INCORRECT_CARD_TYPE = 305;
    const ERROR_INCORRECT_AMOUNT = 306;
    const ERROR_CARD_OUTDATED = 310;
    const ERROR_POSSIBLE_FRAUD = 320;
    const ERROR_CARD_3DS_FAILED = 321;
    const ERROR_CARD_STOLED = 329;
    const ERROR_CARD_ACQUIRER = 330;
    const ERROR_CARD_USAGES_LIMIT_EXCEEDED = 350;
    const ERROR_CARD_AMOUNT_LIMIT_EXCEEDED = 351;
    const ERROR_CARD_LOW_FUNDS = 352;
    const ERROR_CARD_HOLDER_DENIED_TRANSACTION = 353;
    const ERROR_CARD_ACQUIRER_DENIED_TRANSACTION = 354;
    const ERROR_CARD_GENERAL = 389;
    const ERROR_CARD_LIMIT = 390;
    const ERROR_CARD_LOCKED = 391;
    const ERROR_FRAUD = 400;
    const ERROR_PHONE_NUMBER_NOT_CONFIRMED = 401;

    /**
     * Error codes to messages mapping.
     *
     * @var array
     */
    protected static $errors = [
        self::ERROR_NONE                             => 'ERROR_NONE',
        self::ERROR_UNKNOWN                          => 'ERROR_UNKNOWN',
        self::ERROR_GENERAL                          => 'ERROR_GENERAL',
        self::ERROR_PAYMENT_SYSTEM                   => 'ERROR_PAYMENT_SYSTEM',
        self::ERROR_ISSUING_INVOICE                  => 'ERROR_ISSUING_INVOICE',
        self::ERROR_INCORRECT_REQUEST                => 'ERROR_INCORRECT_REQUEST',
        self::ERROR_LIMIT_EXCEEDED                   => 'ERROR_LIMIT_EXCEEDED',
        self::ERROR_PAYMENT_CANCELED                 => 'ERROR_PAYMENT_CANCELED',
        self::ERROR_CUSTOMER_DATA                    => 'ERROR_CUSTOMER_DATA',
        self::ERROR_PHONE_NUMBER                     => 'ERROR_PHONE_NUMBER',
        self::ERROR_INCORRECT_TRANSACTION            => 'ERROR_INCORRECT_TRANSACTION',
        self::ERROR_INCORRECT_CARD_NUMBER            => 'ERROR_INCORRECT_CARD_NUMBER',
        self::ERROR_INCORRECT_CARD_HOLDER_NAME       => 'ERROR_INCORRECT_CARD_HOLDER_NAME',
        self::ERROR_INCORRECT_CARD_CVV2_CVC2         => 'ERROR_INCORRECT_CARD_CVV2_CVC2',
        self::ERROR_INCORRECT_CARD_VALIDITY_DATE     => 'ERROR_INCORRECT_CARD_VALIDITY_DATE',
        self::ERROR_INCORRECT_CARD_TYPE              => 'ERROR_INCORRECT_CARD_TYPE',
        self::ERROR_INCORRECT_AMOUNT                 => 'ERROR_INCORRECT_AMOUNT',
        self::ERROR_CARD_OUTDATED                    => 'ERROR_CARD_OUTDATED',
        self::ERROR_POSSIBLE_FRAUD                   => 'ERROR_POSSIBLE_FRAUD',
        self::ERROR_CARD_3DS_FAILED                  => 'ERROR_CARD_3DS_FAILED',
        self::ERROR_CARD_STOLED                      => 'ERROR_CARD_STOLED',
        self::ERROR_CARD_ACQUIRER                    => 'ERROR_CARD_ACQUIRER',
        self::ERROR_CARD_USAGES_LIMIT_EXCEEDED       => 'ERROR_CARD_USAGES_LIMIT_EXCEEDED',
        self::ERROR_CARD_AMOUNT_LIMIT_EXCEEDED       => 'ERROR_CARD_AMOUNT_LIMIT_EXCEEDED',
        self::ERROR_CARD_LOW_FUNDS                   => 'ERROR_CARD_LOW_FUNDS',
        self::ERROR_CARD_HOLDER_DENIED_TRANSACTION   => 'ERROR_CARD_HOLDER_DENIED_TRANSACTION',
        self::ERROR_CARD_ACQUIRER_DENIED_TRANSACTION => 'ERROR_CARD_ACQUIRER_DENIED_TRANSACTION',
        self::ERROR_CARD_GENERAL                     => 'ERROR_CARD_GENERAL',
        self::ERROR_CARD_LIMIT                       => 'ERROR_CARD_LIMIT',
        self::ERROR_CARD_LOCKED                      => 'ERROR_CARD_LOCKED',
        self::ERROR_FRAUD                            => 'ERROR_FRAUD',
        self::ERROR_PHONE_NUMBER_NOT_CONFIRMED       => 'ERROR_PHONE_NUMBER_NOT_CONFIRMED',
    ];

    /**
     * Returns error message by code.
     *
     * @param  integer     $code
     * @return null|string
     */
    public function getErrorMessage($code)
    {
        if ($code != self::ERROR_NONE && isset(static::$errors[$code])) {
            return static::$errors[$code];
        }

        return null;
    }

    /**
     * Factory method.
     *
     * @param  array                    $input
     * @return \Paybox\Response\Base
     * @throws \Paybox\Exception\Reject
     */
    public static function factory($input)
    {
        if (strcasecmp('error', $input['pg_status']) === 0) {
            throw BaseError::factory($input['pg_status']);
        }

        if (strcasecmp('rejected', $input['pg_status']) === 0) {
            throw new Reject(
                isset(self::$errors[$input['pg_status']]) ? self::$errors[$input['pg_status']] : 'UNKNOWN_REASON',
                $input['pg_status']
            );
        }

        return static::fromArray($input);
    }
}
