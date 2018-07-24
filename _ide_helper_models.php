<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Attribute
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereUpdatedAt($value)
 */
	class Attribute extends \Eloquent {}
}

namespace App{
/**
 * App\AttributeValue
 *
 * @property int $id
 * @property int $attribute_id
 * @property string $value
 * @property-read \App\Attribute $attribute
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributeValue whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributeValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributeValue whereValue($value)
 */
	class AttributeValue extends \Eloquent {}
}

namespace App{
/**
 * App\Brand
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $logo
 * @property bool|null $featured
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read null $translated
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Translation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand withTranslation($locale = null, $fallback = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand withTranslations($locales = null, $fallback = true)
 */
	class Brand extends \Eloquent {}
}

namespace App{
/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $image
 * @property bool $featured
 * @property int|null $parent_id
 * @property int $department_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $children
 * @property-read \App\Department $department
 * @property-read null $translated
 * @property-read \App\Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Translation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category withTranslation($locale = null, $fallback = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category withTranslations($locales = null, $fallback = true)
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\CategoryProduct
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $category_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryProduct whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryProduct whereUpdatedAt($value)
 */
	class CategoryProduct extends \Eloquent {}
}

namespace App{
/**
 * App\Coupon
 *
 * @property int $id
 * @property string $code
 * @property string $type
 * @property int|null $value
 * @property int|null $percent_off
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon wherePercentOff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Coupon whereValue($value)
 */
	class Coupon extends \Eloquent {}
}

namespace App{
/**
 * App\Department
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $image
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $content
 * @property-read null $translated
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Translation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department withTranslation($locale = null, $fallback = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Department withTranslations($locales = null, $fallback = true)
 */
	class Department extends \Eloquent {}
}

namespace App{
/**
 * App\Order
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $billing_email
 * @property string $billing_name
 * @property string $billing_address
 * @property string $billing_city
 * @property string $billing_province
 * @property string $billing_postalcode
 * @property string $billing_phone
 * @property string $billing_name_on_card
 * @property int $billing_discount
 * @property string|null $billing_discount_code
 * @property int $billing_subtotal
 * @property int $billing_tax
 * @property int $billing_total
 * @property string $payment_gateway
 * @property bool $shipped
 * @property string|null $error
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingDiscountCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingNameOnCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingPostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereBillingTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePaymentGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereShipped($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App{
/**
 * App\OrderProduct
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $product_id
 * @property int $quantity
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereUpdatedAt($value)
 */
	class OrderProduct extends \Eloquent {}
}

namespace App{
/**
 * App\Product
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $details
 * @property int $price
 * @property string|null $description
 * @property bool $featured
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $image
 * @property string|null $images
 * @property int|null $regular_price
 * @property int|null $brand_id
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property bool|null $variant_alert_flg
 * @property-read \App\Brand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read null $translated
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Translation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product mightAlsoLike()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereRegularPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereVariantAlertFlg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product withTranslation($locale = null, $fallback = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product withTranslations($locales = null, $fallback = true)
 */
	class Product extends \Eloquent {}
}

namespace App{
/**
 * App\ProductAttribute
 *
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Attribute $attribute
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductAttributeDetail[] $details
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttribute whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttribute whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttribute whereUpdatedAt($value)
 */
	class ProductAttribute extends \Eloquent {}
}

namespace App{
/**
 * App\ProductAttributeDetail
 *
 * @property int $id
 * @property int $product_attribute_id
 * @property int $attribute_value_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\AttributeValue $attributeValue
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttributeDetail whereAttributeValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttributeDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttributeDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttributeDetail whereProductAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductAttributeDetail whereUpdatedAt($value)
 */
	class ProductAttributeDetail extends \Eloquent {}
}

namespace App{
/**
 * App\ProductProperty
 *
 * @property int $id
 * @property int $property_id
 * @property string $value
 * @property int $product_id
 * @property int|null $display_order
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Property $property
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductProperty whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductProperty whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductProperty whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductProperty wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductProperty whereValue($value)
 */
	class ProductProperty extends \Eloquent {}
}

namespace App{
/**
 * App\ProductSKU
 *
 */
	class ProductSKU extends \Eloquent {}
}

namespace App{
/**
 * App\ProductVariant
 *
 */
	class ProductVariant extends \Eloquent {}
}

namespace App{
/**
 * App\Property
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $group
 * @property int|null $display_order
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Property whereUpdatedAt($value)
 */
	class Property extends \Eloquent {}
}

namespace App{
/**
 * App\Slider
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SliderImage[] $slides
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Slider whereUpdatedAt($value)
 */
	class Slider extends \Eloquent {}
}

namespace App{
/**
 * App\SliderImage
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $slider_id
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereSliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereUpdatedAt($value)
 */
	class SliderImage extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $avatar
 * @property int|null $role_id
 * @property mixed $locale
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @property-read \TCG\Voyager\Models\Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

