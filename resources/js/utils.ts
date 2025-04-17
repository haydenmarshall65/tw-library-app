const getRandomNum = (min: number, max: number) => {
    return Math.floor(Math.random() * (max - min) + min);
}

type Book = {
    id: number
    title: string
    author: string
    description: string
    cover_image: string | null
    publisher: string
    publication_date: string
    category: string
    isbn: string
    page_count: number
    checked_out_by: []
}

export {
    getRandomNum,
    type Book
}