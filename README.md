# Real-Time Analytics Service

## Task Overview
**Objective:**  
This project is designed to assess skills in high-load service design, Apache Kafka integration, API development, and object-oriented programming principles.

**Scenario:**  
Develop a scalable, real-time analytics service that can handle millions of user events per second. The service captures, processes, and stores event data for real-time and historical analytics. This data will be consumed by other services and displayed on a dashboard for analysis.

## Requirements

### 1. Event Processing Pipeline
- Design a PHP service integrating **Apache Kafka** as the primary message broker.
- **Event Structure:** Each event should contain:
    - `event_id`: Unique identifier of the event
    - `user_id`: Unique identifier for the user
    - `event_type`: Type of event (e.g., `click`, `view`, `purchase`)
    - `timestamp`: UNIX timestamp when the event occurred
    - `metadata`: JSON object with additional event data
- Ensure the pipeline handles **high loads** (200,000+ events per second).

### 2. Event Storage and Retrieval
- Design the system to store event data in a suitable database for real-time analytics.
- Implement an **API endpoint** to fetch historical event data, filtered by `user_id` and `event_type` within a time range.
- Apply **indexing strategies** and **database optimizations** for handling high-frequency reads and writes.

### 3. Real-Time Aggregation Service
- Implement a service to calculate real-time statistics (e.g., count, average) for specific event types.
- Push aggregated data to **Kafka**, enabling other services to subscribe to these statistics in real-time.

### 4. API Design
Design a REST API with the following endpoints:
- `POST /events`: Accepts incoming events (validates input structure).
- `GET /events`: Retrieves historical data based on filters (`user_id`, `event_type`, time range).
- `GET /stats`: Provides real-time statistics for a specified `event_type` and `time_interval`.

**Documentation** should include:
- Expected input, output, status codes, and any error handling.

### 5. OOP and Code Quality
- Follow **OOP best practices** (e.g., SOLID principles) for maintainability and extensibility.
- Use design patterns (e.g., Factory, Singleton, Observer) where appropriate.
- Ensure code complies with **PSR standards**.

### 6. Testing and Performance
- **Unit Tests**: Write unit tests for key components (e.g., event processing, API endpoints).
- **Load Testing**: Implement basic load testing (e.g., using Apache JMeter) to assess performance under high load.
- Document any **caching strategies** or **optimizations** for handling high requests per second (RPS).

## Deliverables

1. **Code Submission**:
    - A GitHub repository or a zip file with well-organized, PSR-compliant code.

2. **Documentation**:
    - API documentation (e.g., using Swagger or a similar tool).
    - A short summary detailing your approach to high-load handling, Kafka integration, and design decisions.

3. **Testing Results**:
    - Include unit tests and load test results, if available.

## Evaluation Criteria

Your submission will be evaluated on the following:

- **Kafka Integration**: Proper usage of Kafka for message brokering and real-time processing.
- **High-Load Architecture**: A robust and scalable system capable of handling high loads.
- **API Design**: Clear, well-documented, and functional API design.
- **Code Quality**: High-quality code adhering to OOP and PSR standards.
- **Testing and Optimization**: Effective testing and performance optimizations.
- **No frameworks are allowed**: You can not use any framework, instead work only with composer.

---
