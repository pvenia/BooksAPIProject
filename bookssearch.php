<?php


class bookcl{
	private $books = array('items' => array());
	
/**
 * Searches the Google Books database through their public API
 * and returns the result. Notice that this function will (due to
 * Google's restriction) perform one request per 40 books.
 * If there aren't as many books as requested, those found will be
 * returned. If no books at all is found, false will be returned.
 * 
 * @param string $query Search-query, API documentation
 * @param int $numBooksToGet Amount of results wanted
 * @param int [optional] $startIndex Which index to start searching from
 * @return False if no book is found, otherwise the books
 */
	
	public function getBooks($query, $numBooksToGet, $startIndex = 0) {

    // If we've already fetched all the books needed, or
    // all results are already stored
    if(count($this->books['items']) >= $numBooksToGet){
        return $this->books;
	}
	$_COOKIE['totItems'] = count($this->books['items']);
    $booksNeeded = $numBooksToGet - count($this->books['items']);
	// Max books / fetch = 40, this is therefore our limit
    if($booksNeeded > 40)
        $booksNeeded = 40;

    $url = "https://www.googleapis.com/books/v1/volumes?q=". urlencode($query) ."&startIndex=$startIndex&maxResults=$booksNeeded";

	// Get the data with cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $bookBatch = curl_exec($ch);
    curl_close($ch);
	
	// Convert the JSON to an array and merge the existing books with
    // this request's new books 
    $bookBatch = json_decode($bookBatch, true);
	$this->books['items'] = array_merge($this->books['items'], $bookBatch['items']);

	if($bookBatch['totalItems'] === 0) {
		$msg1="no items found!!";
		echo "<script type='text/javascript'>alert('$msg1');</script>";
		return false;
	}
        // .. but we already have some books, return those
    else if(count($this->books) > 0){
		if( ($bookBatch['totalItems'] - count($this->books['items'])) === 0 ) {
			return $this->books;
		}
		else {
		// We need more books, and there's more to get: use recursion
		return $this->getBooks($query, $numBooksToGet, $startIndex);
		echo "<script type='text/javascript'>alert('$this');</script>";
		}
	}
	echo books;
	}
	
	public function array_value_recursive($key, array $arr){
    $val = array();
    array_walk_recursive($arr, function($v, $k) use($key, &$val){
        if($k == $key) array_push($val, $v);
    });
    return count($val) > 1 ? $val : array_pop($val);
	}
	
	public function findKey($array, $keySearch){
		foreach ($array as $key => $item) {
			if ($key == $keySearch) {
				//echo 'yes, it exists';
				return true;
			}
		}
    return false;
	}
}

?>
