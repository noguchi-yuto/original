
window.onload = async function() {
  var q = document.getElementById('q');
  var book_isbn = document.getElementById('book_isbn');
  var book_author = document.getElementById('book_author');
  var book_publisher = document.getElementById('book_publisher');
  var book_coverURL = document.getElementById('book_coverURL');
  var results = document.getElementById('results');
  var results_map = document.getElementById('results_map');
  var MAX_TITLE_LENGTH = 10;
  
  var search = async () => {
    var items = await searchBooks(q.value);
    var query = q.value.trim();
    if(query == ""){
      return;
    }
    var result = `<h2 class="mb-8">検索結果</h2>`;
    var texts = items.map(item => {
    var truncatedTitle = item.title.length > MAX_TITLE_LENGTH ? item.title.slice(0, MAX_TITLE_LENGTH) + '...' : item.title;
    return `
      <div class="my-4 mx-2 book-result" data-title='${item.title}' data-isbn='${item.isbn}' data-image='${item.image}' 
        data-author='${item.author}' data-publisher='${item.publisher}'>
        <img class='w-32 h-44 object-fit-contain bg-gray' src='${item.image}' />
        <div class='p16'>
          <h3 class='mb8'>${truncatedTitle}</h3>
        </div>
      </div>`;
    });
    results.innerHTML = result;
    results_map.innerHTML = texts.join('');
  };

  results_map.addEventListener('click', function(event) {
    var target = event.target.closest('.book-result');
    if (target) {
      var title = target.dataset.title;
      var isbn = target.dataset.isbn;
      var author = target.dataset.author;
      var publisher = target.dataset.publisher;
      var cover = target.dataset.image;
      q.value = title;
      book_isbn.value = isbn;
      book_author.value = author;
      book_publisher.value = publisher;
      book_coverURL.value = cover;
      results.innerHTML = '';
    }
  });

  q.oninput = _.debounce(search, 256);

  q.onfocus = () => { q.select(); };

};

// 本を検索して結果を返す
var searchBooks = async (query) => {
  // Google Books APIs のエンドポイント
  var endpoint = 'https://www.googleapis.com/books/v1';
  var apikey = "AIzaSyCDsgt9NsatmFxtpT8Fs6Y7-IT3ixIP45E";
  // 検索 API を叩く
  var res = await fetch(`${endpoint}/volumes?q=${q.value} &key=${apikey}`);
  // JSON に変換
  var data = await res.json();
  // 必要なものだけ抜き出してわかりやすいフォーマットに変更する
  var items = data.items.map(item => {
    var vi = item.volumeInfo;
    var authors= vi.authors
    return {
      title: vi.title,
      description: vi.description,
      image: vi.imageLinks ? vi.imageLinks.smallThumbnail : '/png/20220330_object.png',
      isbn: findISBN(vi.industryIdentifiers),
      author: authors ? authors.join('　') : null,
      publisher: vi.publisher ? vi.publisher : '',
    }; 
  });
  return items;
};
// ISBNコードを取得するヘルパー関数
function findISBN(identifiers) {
if (!identifiers || identifiers.length === 0) {
return '';
}

// ISBN_10 または ISBN_13 のエントリを探す
var isbnEntry = identifiers.find(identifier =>
identifier.type === 'ISBN_10' || identifier.type === 'ISBN_13'
);

return isbnEntry ? isbnEntry.identifier : '';
}