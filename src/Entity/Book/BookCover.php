<?php

namespace App\Entity\Book;

use App\Entity\Media\File;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable()
 */
#[ORM\Entity]
#[ORM\Table(name: 'app_book_cover')]
class BookCover extends File
{
    /**
     * @Vich\UploadableField(mapping="book_cover", fileNameProperty="path")
     */
    #[\Symfony\Component\Validator\Constraints\File(maxSize: '6000000', mimeTypes: ['image/*'])]
    protected ?\SplFileInfo $file = null;
}
