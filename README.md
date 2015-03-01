# hashDB2 #
---
      
`hashDB2` is a PHP library for storing hashes of various types in various file formats.
It can be used to store file hashes, to monitor when files have been changed; it also allows for arbitrary data to be hashed.

---
### Usage ###
---

  Usage: `hashDB.php [filename]`
  By default, this will check the stored hash of filename against the current hash.  The script will output _'changed'_ if the file has changed OR the file did not exist in the database _(including if the database file itself did not exist)_, and _'unchanged'_ if the file is unchanged.  After reporting this, the database is updated with the current file hash.

  If the specified file does not exist, the script will output _'invalid_filename'_, and exit.


---
### Classes ###
---
  All classes are under the `\HashDB2` namespace.

  - `Hashers\`
    - `Hashers\IHasher` - Base interface partially implemented by `Hasher`.
    - `Hashers\Hasher` - Base class that all Hasher classes must extend.
    - `Hashers\SHA1Hasher` -  Implements the SHA1 hashing algorithm.
    - `Hashers\MD5Hasher` -  Implements the MD5 hashing algorithm.
    - `Hashers\CRC32Hasher` -  Implements the CRC32 hashing algorithm.
  - `Storage\`
    - `Storage\HashStorage` - Base class that all Storage classes must extend.
    - `Storage\IniHashStorage` - _*.ini_ file-based hash storage.
  - @todo

---
### @todo ###
---

  - Write proper readme.
  - Implement HashDB2 class.
  - Implement XML storage.
  - Document code and usage.
  - Code Examples.
  - Virtualize filesystem calls in tests that depend on the file system.
  - Make certain tests more robust.
  - ...?


---
### License ###
---

`hashDB2` is available under the <a href="LICENSE">MIT License</a>.

