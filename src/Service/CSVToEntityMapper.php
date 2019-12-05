<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Entities\PersonsLegal;
use Commissioner\CommissionTask\Entities\PersonsNatural;
use Commissioner\CommissionTask\Exceptions\UnsupportedFileFormatException;
use Commissioner\CommissionTask\Interfaces\CSVToEntityMapperInterface;
use Commissioner\CommissionTask\Interfaces\PersonsInterface;
use Illuminate\Support\Collection;
use Symfony\Component\ErrorHandler\Error\ClassNotFoundError;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class CSVToEntityMapper implements CSVToEntityMapperInterface
{
    /**
     * @const string
     */
    const TYPE = 'stream';

    /**
     * @const string
     */
    const CLASS_PATH = 'Commissioner\CommissionTask\Entities\Persons';

    /**
     * @const string
     */
    const PERSONS = [PersonsLegal::TYPE, PersonsNatural::TYPE];

    /**
     * This will hold the collection of person interface.
     *
     * @var \Commissioner\CommissionTask\Interfaces\PersonsInterface[]
     */
    protected $persons;

    /**
     * This will be the format of data for the person entities.
     *
     * @var string[]
     */
    private $personData;

    /**
     * @var int
     */
    private $length;

    /**
     * @var string
     */
    private $delimiter;

    /**
     * @var string
     */
    private $dirPath;

    /**
     * CSVToEntityMapper constructor.
     */
    public function __construct(string $delimiter, string $dirPath, int $length, array $personData = [])
    {
        $this->delimiter = $delimiter;
        $this->dirPath = $dirPath;
        $this->length = $length;
        $this->personData = $personData;
    }

    /**
     * Set the csv values to be mapped to the persons interface.
     *
     * @param mixed[] $argument
     *
     * @return void
     */
    public function map(array $argument)
    {
        $file = $this->fileParser($argument);
        $openedFile = \fopen($this->dirPath.$file, 'r');
        if ($openedFile === false) {
            throw new FileNotFoundException(\sprintf('File: %s not found', $argument));
        }

        $this->persons = $this->entityFormatter($openedFile);
    }

    /**
     * Return string from parsed file.
     *
     * @param mixed[] $argument
     */
    private function fileParser(array $argument): string
    {
        $file = $argument[1] ?? '';
        if (empty($file) === true) {
            throw new FileNotFoundException('File not found.');
        }

        // We will restrict this to only 1 csv file at a time.
        $format = \explode('.', $argument[1])[1] ?? '';

        if ($format !== 'csv') {
            throw new UnsupportedFileFormatException(null, 0, null, $format);
        }

        return $file;
    }

    /**
     * Return a collection of the resolved persons entities.
     *
     * @param $file
     *
     * @return \Illuminate\Support\Collection|\Commissioner\CommissionTask\Interfaces\PersonsInterface[]
     */
    private function entityFormatter($file): Collection
    {
        $count = 0;
        $collection = new Collection();

        if (\get_resource_type($file) !== 'stream') {
            throw new FileNotFoundException('No file is in input stream.');
        }

        $data = [];

        while (($row = \fgetcsv($file, $this->length, $this->delimiter)) !== false) {
            $data[] = $row;
            $collection->add($this->entityMapper($data[$count] ?? []));
            ++$count;
        }
        fclose($file);

        return $collection;
    }

    /**
     * Return the resolved instance of the Persons entity.
     *
     * @param string[] $personArray
     */
    private function entityMapper(array $personArray): PersonsInterface
    {
        $this->personData = [
            'operation_date' => $personArray[0] ?? '',
            'identification' => $personArray[1] ?? '',
            'person_type' => $personArray[2] ?? '',
            'operation_type' => $personArray[3] ?? '',
            'operation_amount' => $personArray[4] ?? '',
            'operation_currency' => $personArray[5] ?? '',
        ];

        if (\in_array($this->personData['person_type'], self::PERSONS, true) === false) {
            throw new ResourceNotFoundException(\sprintf('Resource %s not found.', $personArray[2] ?? ''));
        }

        $person = $this->getPersonsClass($this->personData['person_type']);

        if (\class_exists($person) === false) {
            throw new ClassNotFoundError(\sprintf('Class %s not found.', $person), new \Exception());
        }

        return new $person($this->personData);
    }

    /**
     * Return a formatted class string of a person entity.
     */
    private function getPersonsClass(string $type): string
    {
        return \sprintf('%s%s', self::CLASS_PATH, \ucfirst($type));
    }

    /**
     * Return the resolved (mapped) interface.
     *
     * @return \Illuminate\Support\Collection|\Commissioner\CommissionTask\Interfaces\PersonsInterface[]
     */
    public function getPersons(): Collection
    {
        return $this->persons;
    }
}
