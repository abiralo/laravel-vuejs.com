<?php

namespace Next\Controllers\Api;

use Next\Controllers\Api\Response\ResponseBuilder;
use Next\Models\Attachment;
use Next\Services\LanguageService;
use Next\Services\SettingService;

/**
 * Class PostController
 * @package Next\Controllers\Api
 */
class SettingsController extends ApiBaseController
{

    /** @var LanguageService */
    protected $languageService;

    /** @var SettingService */
    protected $settingService;

    public function __construct(
        ResponseBuilder $responseBuilder,
        LanguageService $languageService,
        SettingService $settingService
    )
    {
        parent::__construct($responseBuilder);

        $this->languageService = $languageService;
        $this->settingService = $settingService;
    }

    /**
     * @api {get} :local/post/:id Get a single post
     * @apiName GetPost
     * @apiGroup Posts
     *
     * @apiParam {String} locale fr|ar
     * @apiParam {Number} id Unique ID of the Post.
     *
     * @apiSuccess {Object[]} post Object containing post information.
     * @apiSuccess {number} post.id ID of the post.
     * @apiSuccess {String} post.title Title of the post.
     * @apiSuccess {String} post.slug Slug of the post.
     * @apiSuccess {String} post.content Content of the post.
     * @apiSuccess {String} post.image Featured image of the post.
     * @apiSuccess {String[]} post.terms taxonomies of the post.
     * @apiSuccess {String[]} post.author author of the post.
     * @apiSuccess {String[]} post.keywords keywords of the post.
     * @apiSuccess {String} post.main_category Main category of the post.
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "global": {
     *              "website_title": "Medi1radio",
     *              "website_description": "Medi1radio description ",
     *              "header_logo": {
     *              "title": "blue-brand",
     *              "url": "http://nextstarter.nextmedia.ma/content/uploads/2018/08/blue-brand.png",
     *              "type": null,
     *              "alt": null,
     *              "description": "logo descriptioon"
     *          },
     *          "footer_logo": {
     *              "title": "blue-brand",
     *              "url": "http://nextstarter.nextmedia.ma/content/uploads/2018/08/blue-brand.png",
     *              "type": null,
     *              "alt": null,
     *              "description": "logo descriptioon"
     *          }
     *      },
     *      "menus": {
     *          "main_menu": {
     *              "id": 25,
     *              "name": "main menu fr",
     *              "slug": "main-menu-fr",
     *              "items": [
     *                  {
     *                      "name": "Home",
     *                      "url": "http://nextstarter.nextmedia.ma/",
     *                      "object": "custom"
     *                  },
     *                  {
     *                      "name": "Monde",
     *                      "url": "http://nextstarter.nextmedia.ma/category/monde/",
     *                      "object": "category"
     *                  },
     *                  {
     *                      "name": "Sport",
     *                      "url": "http://nextstarter.nextmedia.ma/category/sport/",
     *                      "object": "category"
     *                  }
     *              ]
     *          },
     *          "navbar_menu": {
     *              "id": 25,
     *              "name": "main menu fr",
     *              "slug": "main-menu-fr",
     *              "items": [
     *                  {
     *                      "name": "Home",
     *                      "url": "http://nextstarter.nextmedia.ma/",
     *                      "object": "custom"
     *                  },
     *                  {
     *                      "name": "Monde",
     *                      "url": "http://nextstarter.nextmedia.ma/category/monde/",
     *                      "object": "category"
     *                  },
     *                  {
     *                      "name": "Sport",
     *                      "url": "http://nextstarter.nextmedia.ma/category/sport/",
     *                      "object": "category"
     *                  }
     *              ]
     *          },
     *          "hashtags_menu": {
     *              "id": 25,
     *              "name": "main menu fr",
     *              "slug": "main-menu-fr",
     *              "items": [
     *                  {
     *                      "name": "Home",
     *                      "url": "http://nextstarter.nextmedia.ma/",
     *                      "object": "custom"
     *                  },
     *                  {
     *                      "name": "Monde",
     *                      "url": "http://nextstarter.nextmedia.ma/category/monde/",
     *                      "object": "category"
     *                  },
     *                  {
     *                      "name": "Sport",
     *                      "url": "http://nextstarter.nextmedia.ma/category/sport/",
     *                      "object": "category"
     *                  }
     *              ]
     *          },
     *          "footer_menu": {
     *              "id": 25,
     *              "name": "main menu fr",
     *              "slug": "main-menu-fr",
     *              "items": [
     *                  {
     *                      "name": "Home",
     *                      "url": "http://nextstarter.nextmedia.ma/",
     *                      "object": "custom"
     *                  },
     *                  {
     *                      "name": "Monde",
     *                      "url": "http://nextstarter.nextmedia.ma/category/monde/",
     *                      "object": "category"
     *                  },
     *                  {
     *                      "name": "Sport",
     *                      "url": "http://nextstarter.nextmedia.ma/category/sport/",
     *                      "object": "category"
     *                  }
     *              ]
     *          }
     *      },
     *      "links": {
     *          "facebook": "https://facebook.com",
     *          "twitter": "https://twitter.com",
     *          "youtube": "https://youtube.com",
     *          "instagram": "https://instagram.com",
     *          "play_store": "https://play.google.com",
     *          "apple_store": "https://apple.com"
     *      }
     *  }
     *
     */
    public function index($locale = null)
    {
        $global = $this->settingService->getGlobalSettings($locale);

        return $this->responseBuilder->withArray([
            'global' => $global,
            'menus' => $this->settingService->getMenusSettings($locale),
            'links' => $this->settingService->getLinksSettings($locale)
        ]);

    }

    /**
     * @api {get} :local/post/:id Get a single post
     * @apiName GetPost
     * @apiGroup Posts
     *
     * @apiParam {String} locale fr|ar
     * @apiParam {Number} id Unique ID of the Post.
     *
     * @apiSuccess {Object[]} post Object containing post information.
     * @apiSuccess {number} post.id ID of the post.
     * @apiSuccess {String} post.title Title of the post.
     * @apiSuccess {String} post.slug Slug of the post.
     * @apiSuccess {String} post.content Content of the post.
     * @apiSuccess {String} post.image Featured image of the post.
     * @apiSuccess {String[]} post.terms taxonomies of the post.
     * @apiSuccess {String[]} post.author author of the post.
     * @apiSuccess {String[]} post.keywords keywords of the post.
     * @apiSuccess {String} post.main_category Main category of the post.
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     *  "is_active" : "Active",
     *  "post"     :  {
     *          "id": 1,
     *          "title": "Title of the post",
     *          "slug": "slug-of-the-post",
     *          "type": "post",
     *          "content": "Content of post with ID 1",
     *          "image": "http://dev.nexstarter.com/content/uploads/2018/07/Asset-1@1x-1.png",
     *          'author': {
     *              'id': 1,
     *              'slug': "nextmedia",
     *              'name': "Nextmedia",
     *              'first_name": "karkar",
     *              'last_name": "Benabdou",
     *              'avatar': "//secure.gravatar.com/avatar/b032b0794d92f1afb889ced465ddecc9?d=mm"
     *          },
     *          "main_category": "Non classé",
     *          "categories": [
     *          {
     *              "id": 2,
     *              "type": "category",
     *              "name": "Sport",
     *              "slug": "sport",
     *              "description": null,
     *              "group": 0,
     *              "total": 11,
     *              "locale": "fr"
     *          },
     *          {
     *              "id": 4,
     *              "type": "category",
     *              "name": "Maroc",
     *              "slug": "maroc",
     *              "description": null,
     *              "group": 0,
     *              "total": 6,
     *              "locale": "fr"
     *          },
     *          "tags": [
     *          {
     *              "id": 29,
     *              "type": "post_tag",
     *              "name": "Football",
     *              "slug": "football",
     *              "description": null,
     *              "group": 0,
     *              "total": 1,
     *              "locale": null
     *          },
     *          {
     *              "id": 30,
     *              "type": "post_tag",
     *              "name": "Maroc",
     *              "slug": "maroc",
     *              "description": null,
     *              "group": 0,
     *              "total": 1,
     *              "locale": null
     *          },
     *          "keywords": [
     *              "sport",
     *              "monde",
     *              "nextstarter"
     *          ],
     *          "keywords_str": "Non classé,Sport,bonjour,monde,nextstarter",
     *          "format": false,
     *          "locale": "fr",
     *          "created": "2018-07-13 02:07:17",
     *          "updated": "2018-08-13 20:08:52"
     *      }
     *}
     * @param null $locale
     * @return array
     */
    public function breakingNews($locale = null)
    {
        return $this->settingService->getBreakingNewsSettings($locale);
    }
}