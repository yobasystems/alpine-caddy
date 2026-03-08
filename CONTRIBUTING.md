# Contributing to Alpine alpine-caddy

First off, thank you for considering contributing to this project! It's people like you that make this project better for everyone.

## 📋 Table of Contents

- [Code of Conduct](#code-of-conduct)
- [How Can I Contribute?](#how-can-i-contribute)
- [Development Setup](#development-setup)
- [Pull Request Process](#pull-request-process)
- [Code Style Guidelines](#code-style-guidelines)
- [Testing](#testing)
- [Reporting Issues](#reporting-issues)

## Code of Conduct

This project and everyone participating in it is governed by basic principles of respect and professionalism. By participating, you are expected to uphold this code. Please report unacceptable behavior to the maintainers.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the issue list as you might find out that you don't need to create one. When you are creating a bug report, please include as many details as possible:

- **Use a clear and descriptive title**
- **Describe the exact steps to reproduce the problem**
- **Provide specific examples to demonstrate the steps**
- **Describe the behavior you observed and what behavior you expected**
- **Include screenshots and animated GIFs if helpful**
- **Include your environment details** (OS, Docker version, etc.)

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub/GitLab issues. When creating an enhancement suggestion, include:

- **Use a clear and descriptive title**
- **Provide a step-by-step description of the suggested enhancement**
- **Provide specific examples to demonstrate the steps**
- **Describe the current behavior and explain the behavior you expected**
- **Explain why this enhancement would be useful**

### Pull Requests

- Fill in the required template
- Do not include issue numbers in the PR title
- Include screenshots and animated GIFs in your pull request whenever possible
- Follow the shell script style guidelines
- Document new code
- End all files with a newline

## Development Setup

### Prerequisites

- Docker (version 20.10 or later)
- Docker Compose (version 2.x or later)
- Git
- Make (optional)

### Local Development

1. **Fork and clone the repository**
   ```bash
   git clone https://github.com/yobasystems/alpine-caddy.git
   cd alpine-caddy
   ```

2. **Build the Docker image**
   ```bash
   docker build -t yobasystems/alpine-caddy:local .
   ```

3. **Test the image**
   ```bash
   docker compose up -d
   docker compose logs -f
   ```

4. **Make your changes**
   - Edit Dockerfiles, scripts, or configuration files
   - Test your changes locally
   - Ensure all architectures build successfully

5. **Test multi-architecture builds** (if applicable)
   ```bash
   # For amd64
   docker build -t yobasystems/alpine-caddy:amd64-local -f [ARCH-DIR]/Dockerfile .
   
   # For arm64
   docker build -t yobasystems/alpine-caddy:arm64-local -f [ARCH-DIR]/Dockerfile .
   ```

## Pull Request Process

1. **Create a feature branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make your changes**
   - Follow the code style guidelines
   - Add tests if applicable
   - Update documentation

3. **Commit your changes**
   ```bash
   git add .
   git commit -m "type: brief description of your change"
   ```
   
   **Commit Message Format:**
   - `feat:` - A new feature
   - `fix:` - A bug fix
   - `docs:` - Documentation only changes
   - `style:` - Changes that do not affect the meaning of the code
   - `refactor:` - A code change that neither fixes a bug nor adds a feature
   - `test:` - Adding missing tests or correcting existing tests
   - `chore:` - Changes to the build process or auxiliary tools

4. **Push to your fork**
   ```bash
   git push origin feature/your-feature-name
   ```

5. **Open a Pull Request**
   - Go to the original repository
   - Click "New Pull Request"
   - Select your feature branch
   - Fill in the PR template
   - Submit the PR

6. **PR Review Process**
   - Maintainers will review your PR
   - Address any feedback or requested changes
   - Once approved, a maintainer will merge your PR

## Code Style Guidelines

### Dockerfile Style

- Use multi-stage builds when appropriate
- Minimize the number of layers
- Order instructions from least to most frequently changing
- Use `.dockerignore` to exclude unnecessary files
- Prefer `COPY` over `ADD`
- Use `LABEL` instructions to add metadata
- Always pin package versions in production images
- Use specific tags instead of `latest`

**Example:**
```dockerfile
FROM alpine:3.19

LABEL maintainer="Yoba Systems <info@yoba.systems>"
LABEL org.opencontainers.image.source="https://github.com/yobasystems/alpine-caddy"

RUN apk add --no-cache \
    package1=1.2.3-r0 \
    package2=4.5.6-r0

COPY files/ /

EXPOSE 8080

CMD ["./run.sh"]
```

### Shell Script Style

- Use `#!/bin/sh` for POSIX compatibility (or `#!/bin/bash` if bash features needed)
- Use `set -e` to exit on error
- Use `set -u` to exit on undefined variables
- Quote all variables: `"${variable}"`
- Use meaningful variable names
- Add comments for complex logic
- Use functions for reusable code
- Always check return codes

**Example:**
```bash
#!/bin/sh
set -e

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $1"
}

log "Starting application..."

if [ -z "${REQUIRED_VAR}" ]; then
    log "ERROR: REQUIRED_VAR is not set"
    exit 1
fi

log "Application started successfully"
```

### YAML Style (docker-compose.yml)

- Use 2 spaces for indentation
- Quote strings that contain special characters
- Use `restart: always` for services
- Include healthchecks where possible
- Use named volumes for persistence
- Use environment variables for configuration

## Testing

### Building Test

```bash
# Test build for all architectures
for arch in amd64 arm64v8 arm32v7; do
    docker build -t test-alpine-caddy:${arch} -f alpine-caddy-${arch}/Dockerfile .
done
```

### Runtime Test

```bash
# Start with docker-compose
docker compose up -d

# Check logs
docker compose logs -f

# Check health
docker compose ps

# Clean up
docker compose down
```

### Integration Test

Test the image with real workloads:
```bash
# For database images
docker exec -it [container] [client-command]

# For web server images
curl http://localhost:[port]

# For application images
docker exec -it [container] [app-command]
```

## Reporting Issues

### Security Issues

**Do not open public issues for security vulnerabilities!**

Please report security issues privately to:
- Email: security@yoba.systems
- Include detailed steps to reproduce
- Include potential impact assessment

### Regular Issues

1. Check existing issues first
2. Use the issue templates if available
3. Provide detailed information:
   - Docker version
   - Operating System
   - Architecture (amd64/arm64/arm32)
   - Steps to reproduce
   - Expected vs actual behavior
   - Logs and error messages

## Questions or Need Help?

- Open a Discussion on GitHub/GitLab
- Check the README.md for documentation
- Review existing issues for similar problems

## License

By contributing to this project, you agree that your contributions will be licensed under the MIT License.

---

Thank you for contributing! 🎉
