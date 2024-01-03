<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Translator;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $authors = Author::all();
        $translators = Translator::all();
        return view('admin.books.create',compact('categories','translators','authors'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $data = $request->validate([
            'title'=>['required','string','max:256'],
            'price'=>['required','max:256'],
            'count'=>['required','string'],
        ]);
        $book = Book::create([
            'title'=>$data['title'],
            'price'=>str_replace( ',', '',$data['price']),
            'count'=>$data['count'],
            'image'=> uploadFile($request->file('image')),
            'attachment'=> uploadFile($request->file('attachment')),
            'discount_percent'=>$request->discount_percent,
            'page_count'=>$request->page_count,
            'editor'=>$request->editor,
            'isbn'=>$request->isbn,
            'published'=>$request->published,
            'publication_frost'=>$request->publication_frost,
            'cut'=>$request->cut,
            'cover'=>$request->cover,
            'about'=>$request->about,
        ]);

        $book->authors()->sync($request->authors);
        $book->translators()->sync($request->translators);
        $book->categories()->sync($request->categories);

        return redirect(route('admin.books.create'))->with('success','کتاب با موفقیت ثبت شد');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $translators = Translator::all();
        $categories = Category::all();
        $authors = Author::all();
        return view('admin.books.edit',compact('book','categories','translators','authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'=>['required','string','max:256'],
            'price'=>['required','max:256'],
            'count'=>['required'],
        ]);
        $book->update([
            'title'=>$data['title'],
            'price'=>str_replace( ',', '',$data['price']),
            'count'=>$data['count'],
            'image'=> uploadFile($request->file('image')),
            'attachment'=> uploadFile($request->file('attachment')),
            'discount_percent'=>$request->discount_percent,
            'page_count'=>$request->page_count,
            'editor'=>$request->editor,
            'isbn'=>$request->isbn,
            'published'=>$request->published,
            'publication_frost'=>$request->publication_frost,
            'cut'=>$request->cut,
            'cover'=>$request->cover,
            'about'=>$request->about,
        ]);
        $book->categories()->sync($request->categories);
        $book->authors()->sync($request->authors);
        $book->translators()->sync($request->translators);
        return back()->with('success','کتاب با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->categories()->detach();
        $book->translators()->detach();
        $book->authors()->detach();
        $book->deleteOrFail();

        return redirect(route('admin.books.index'))->with('success','کتاب با موفقیت حذف شد');
    }


    //categories
    public function categoriesIndex()
    {
        $categories = Category::all();
        return view('admin.books.categories',compact('categories'));
    }

    public function storeCategory(Request $request){

        $data = $request->validate([
            'title'=>['required','string','max:256','unique:categories,title'],
            'description'=>['max:256'],
        ]);
        Category::create([
            'title'=>$data['title'],
            'description'=>$data['description']
        ]);

        return redirect(route('admin.categories.index'))->with('success','دسته‌بندی با موفقیت ثبت شد');
    }
    public function destroyCategory(Category $category){

        $category->deleteOrFail();

        return redirect(route('admin.categories.index'))->with('success','دسته‌بندی با موفقیت حذف شد');
    }


    //translators
    public function translatorsIndex()
    {
        $translators = Translator::all();
        return view('admin.books.translators',compact('translators'));
    }
    public function storeTranslator(Request $request){

        $data = $request->validate([
            'title'=>['required','string','max:256','unique:translators,title'],
            'description'=>['max:256'],
        ]);
        Translator::create([
            'title'=>$data['title'],
            'description'=>$data['description']
        ]);

        return redirect(route('admin.translators.index'))->with('success','مترجم با موفقیت ثبت شد');
    }
    public function destroyTranslator(Translator $translator){
        $translator->books()->detach();
        $translator->deleteOrFail();
        return redirect(route('admin.translators.index'))->with('success','مترجم با موفقیت حذف شد');
    }



    //writers
    public function writersIndex()
    {
        $writers = Author::all();
        return view('admin.books.writers',compact('writers'));
    }
    public function storeWriter(Request $request){

        $data = $request->validate([
            'title'=>['required','string','max:256','unique:authors,title'],
            'description'=>['max:256'],
        ]);
        Author::create([
            'title'=>$data['title'],
            'description'=>$data['description']
        ]);

        return redirect(route('admin.writers.index'))->with('success','نویسنده با موفقیت ثبت شد');
    }
    public function destroyWriter(Author $writer){
        $writer->books()->detach();
        $writer->deleteOrFail();
        return redirect(route('admin.writers.index'))->with('success','نویسنده با موفقیت حذف شد');
    }

}
