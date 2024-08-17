<?php

namespace App\Http\Controllers;

use App\Models\ArticleNews;
use App\Models\Author;
use App\Models\BannerAdvertisement;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
	public function index()
	{
		$categories = Category::all();

		$articles = ArticleNews::with(['category'])
			->where('is_featured', 'not_featured')
			->latest()
			->take(3)
			->get();

		$featured_articles = ArticleNews::with(['category'])
			->where('is_featured', 'featured')
			->inRandomOrder()
			->take(3)
			->get();

		$authors = Author::take(6)->get();

		$banner_ads = BannerAdvertisement::where('is_active', 'active')
			->where('type', 'banner')
			->inRandomOrder()
			->take(1)
			->get();

		$entertainment_articles = ArticleNews::whereRelation('category', 'slug', '=', 'entertainment')
			->where('is_featured', 'not_featured')
			->latest()
			->take(6)
			->get();

		$entertainment_featured_article = ArticleNews::whereRelation('category', 'slug', '=', 'entertainment')
			->where('is_featured', 'featured')
			->inRandomOrder()
			->first();

		$business_articles = ArticleNews::whereRelation('category', 'slug', '=', 'business')
			->where('is_featured', 'not_featured')
			->latest()
			->take(6)
			->get();

		$business_featured_article = ArticleNews::whereRelation('category', 'slug', '=', 'business')
			->where('is_featured', 'featured')
			->inRandomOrder()
			->first();

		$automotive_articles = ArticleNews::whereRelation('category', 'slug', '=', 'automotive')
			->where('is_featured', 'not_featured')
			->latest()
			->take(6)
			->get();

		$automotive_featured_article = ArticleNews::whereRelation('category', 'slug', '=', 'automotive')
			->where('is_featured', 'featured')
			->inRandomOrder()
			->first();

		return view('front.index', compact('categories', 'articles', 'featured_articles', 'authors', 'banner_ads', 'entertainment_articles', 'entertainment_featured_article', 'business_articles', 'business_featured_article', 'automotive_articles', 'automotive_featured_article'));
	}

	public function category(Category $category)
	{
		$categories = Category::all();
		$banner_ads = BannerAdvertisement::where('is_active', 'active')
			->where('type', 'banner')
			->inRandomOrder()
			->take(1)
			->get();

		return view('front.category', compact('category', 'categories', 'banner_ads'));
	}

	public function author(Author $author)
	{
		$categories = Category::all();
		$banner_ads = BannerAdvertisement::where('is_active', 'active')
			->where('type', 'banner')
			->inRandomOrder()
			->take(1)
			->get();

		return view('front.author', compact('author', 'categories', 'banner_ads'));
	}

	public function details(ArticleNews $articleNews)
	{
		$categories = Category::all();
		$banner_ads = BannerAdvertisement::where('is_active', 'active')
			->where('type', 'banner')
			->inRandomOrder()
			->take(1)
			->get();

		$more_from_author = ArticleNews::whereNot('id', $articleNews->id)
			->where('author_id', $articleNews->author_id)
			->inRandomOrder()
			->take(3)
			->get();

		$square_top_ads = BannerAdvertisement::where('is_active', 'active')
			->where('type', 'square')
			->inRandomOrder()
			->take(1)
			->get();

		$square_bottom_ads = BannerAdvertisement::where('is_active', 'active')
			->where('type', 'square')
			->inRandomOrder()
			->take(1)
			->get();

		$other_news = ArticleNews::inRandomOrder()
			->whereNot('author_id', $articleNews->author_id)
			->take(3)
			->get();

		return view('front.details', compact('articleNews', 'categories', 'banner_ads', 'more_from_author', 'square_top_ads', 'square_bottom_ads', 'other_news'));
	}

	public function search(Request $request)
	{
		$categories = Category::all();

		$keyword = $request->keyword;

		$articles = ArticleNews::with(['category', 'author'])
			->where('name', 'like', '%' . $keyword . '%')
			->paginate(6);

		return view('front.search', compact('categories', 'articles', 'keyword', 'articles'));
	}
}
