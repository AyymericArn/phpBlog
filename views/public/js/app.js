import Article from "./Article.js";
import Header from "./Header.js";
import Search from "./Search.js";

const articleHandler = new Article();
const headerHandler = new Header();

const rootLoc = window.location.pathname;
const rootPath = 'http://localhost' +  rootLoc.substring(0, rootLoc.lastIndexOf('/blog')) + '/blog/';

if (window.location.href === rootPath) {
    const searchHandler = new Search(rootPath);
    console.log('suus');
}