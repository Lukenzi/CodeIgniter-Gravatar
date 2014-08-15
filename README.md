CodeIgniter-Gravatar
====================

Třída pro PHP framework **CodeIgniter** pro zobrazení [gravataru](https://cs.gravatar.com/).

Požadavky
---------

* PHP 5.3.0 nebo novější
* Framevork CodeIgniter

Použití
-------

Třídu je třeba před použitím v controlleru prvně načíst:

```php
$this->load->library('gravatar');
```

Poté musíte nastavit emailovou adresu pro vygenerování obrázku:

```php
$this->gravatar->SetEmail('user@email.com');
```

Další volby již povinné nejsou:
```php
// nastavení šířky a výšky obrázku (max 2048px)
$this->gravatar->SetSize(500);

// nastavení typu obrázku pokud uživatel nemá nastaven vlastní obrázek
// (404, mm, identicon, monsterid, wavatar)
$this->gravatar->SetType('wavatar');

// nastavení hodnocení obrázku
// (g, pg, r, x)
$this->gravatar->SetRating('pg');
```

Poté si můžete vybrat zda chcete zobrazit pouze URL adresu k obrázku:
```php
echo $this->gravatar->GetUrl();
```

nebo si můžeme zobrazit kompletní HTML tag pro obrázek i s URL:
```php
echo $this->gravatar->GetImage();
```

Také můžete kontrolovat zda při generování gravataru nedošlo k chybě:
```php
echo $this->gravatar->GetError();
```

Příklady použití v controlleru CodeIgniteru
-------------------------------------------

```php
$this->load->library('gravatar');
$this->gravatar->SetEmail('user@email.com');
$this->gravatar->SetSize(40);
$this->gravatar->SetType('404');

$data['gravatar'] = $this->gravatar->GetImage();
```

