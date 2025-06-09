
# 📚 Biblioteca Virtual - TCC

Este é um projeto de **Biblioteca Virtual** desenvolvido em **Laravel**, com foco em facilitar o acesso gratuito a livros digitais e promover o compartilhamento de conhecimento de forma acessível.

---

## 🚀 Funcionalidades

- 📄 Upload de arquivos PDF
- 🖼️ Conversão automática da **primeira página do PDF em imagem** (para pré-visualização)
- 📥 Download gratuito dos livros
- 📱 Layout responsivo
- 📌 Listagem de livros com título, autor e imagem da capa

---

## 🛠️ Tecnologias Utilizadas

- PHP 8+
- Laravel
- MySQL
- Bootstrap + Tailwind CSS
- Blade (templating)
- Vite (compilação frontend)
- Poppler-utils (`pdftoppm`) – para geração da imagem da capa do PDF

---

## ⚙️ Requisitos para rodar o projeto

Para executar corretamente o projeto em sua máquina, você precisará dos seguintes itens:

1. **PHP 8+**
2. **Composer**
3. **Laravel instalado globalmente**
4. **Node.js e NPM**
5. **MySQL ou outro banco configurado**
6. **Extensões PHP ativadas**
7. **Biblioteca Poppler-utils**  
   - Necessária para gerar a imagem da primeira página dos PDFs (comando `pdftoppm`).
   - No Ubuntu/Debian:
     ```bash
     sudo apt install poppler-utils
     ```
8. **TimeWinge e Multistrap** (caso sejam necessários para partes específicas do backend)
9. **Alterações no `php.ini`:**
   - Para permitir uploads maiores de arquivos PDF, altere:
     ```ini
     upload_max_filesize = 50M
     post_max_size = 50M
     ```

---

## 🔧 Instalação do Projeto

```bash
# Clone o repositório
git clone https://github.com/ChristianKoziel/biblioteca-virtual-tcc.git
cd biblioteca-virtual-tcc

# Instale as dependências do backend
composer install

# Copie o .env e gere a chave do aplicativo
cp .env.example .env
php artisan key:generate

# Configure seu banco de dados no arquivo .env e rode as migrations
php artisan migrate

# Instale as dependências do frontend
npm install

# Compile os assets
npm run dev

# Rode o servidor Laravel
php artisan serve
```

---

## 🌐 Projeto Online

➡️ Acesse a versão online do projeto:  
**https://bookfyapp.com.br/**

---

## 🧠 Observação Final

O sistema aceita apenas arquivos **.pdf**, mas em versões futuras será possível converter e disponibilizar os livros também nos formatos **.epub** e **.mobi**, facilitando o uso em leitores digitais como o **Kindle**.
