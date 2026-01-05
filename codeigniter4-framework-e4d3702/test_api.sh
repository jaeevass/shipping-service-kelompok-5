#!/bin/bash

# Shipping Service API Testing Script
# This script tests all the main API endpoints

BASE_URL="http://localhost:8080/api/shipping"

echo "================================"
echo "Shipping Service API Test Script"
echo "================================"
echo ""
echo "Base URL: $BASE_URL"
echo ""

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}Test 1: Creating first shipping data${NC}"
echo "POST /api/shipping/create"
echo ""
curl -X POST "$BASE_URL/create" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "order_id=ORD-DEMO-001" \
  -d "recipient_name=John Doe" \
  -d "recipient_address=Jl. Merdeka No. 123, Jakarta Pusat, DKI Jakarta 10110" \
  -d "recipient_phone=081234567890" \
  -d "courier_service=JNE Regular" \
  -d "shipping_cost=15000" \
  -d "weight=2.5"
echo ""
echo ""

sleep 1

echo -e "${BLUE}Test 2: Creating second shipping data${NC}"
echo "POST /api/shipping/create"
echo ""
curl -X POST "$BASE_URL/create" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "order_id=ORD-DEMO-002" \
  -d "recipient_name=Jane Smith" \
  -d "recipient_address=Jl. Sudirman No. 456, Jakarta Selatan, DKI Jakarta 12190" \
  -d "recipient_phone=081234567891" \
  -d "courier_service=J&T Express" \
  -d "shipping_cost=12000" \
  -d "weight=1.8"
echo ""
echo ""

sleep 1

echo -e "${BLUE}Test 3: Creating third shipping data${NC}"
echo "POST /api/shipping/create"
echo ""
curl -X POST "$BASE_URL/create" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "order_id=ORD-DEMO-003" \
  -d "recipient_name=Bob Johnson" \
  -d "recipient_address=Jl. Gatot Subroto No. 789, Bandung, Jawa Barat 40262" \
  -d "recipient_phone=081234567892" \
  -d "courier_service=SiCepat Reguler" \
  -d "shipping_cost=18000" \
  -d "weight=3.2"
echo ""
echo ""

sleep 1

echo -e "${BLUE}Test 4: Get shipping status by order ID${NC}"
echo "GET /api/shipping/status/ORD-DEMO-001"
echo ""
curl -X GET "$BASE_URL/status/ORD-DEMO-001"
echo ""
echo ""

sleep 1

echo -e "${BLUE}Test 5: Get all shipping data${NC}"
echo "GET /api/shipping"
echo ""
curl -X GET "$BASE_URL"
echo ""
echo ""

sleep 1

echo -e "${BLUE}Test 6: Get shipping by ID${NC}"
echo "GET /api/shipping/1"
echo ""
curl -X GET "$BASE_URL/1"
echo ""
echo ""

sleep 1

echo -e "${BLUE}Test 7: Update shipping status${NC}"
echo "PUT /api/shipping/1"
echo ""
curl -X PUT "$BASE_URL/1" \
  -H "Content-Type: application/json" \
  -d '{"status": "in_transit"}'
echo ""
echo ""

sleep 1

echo -e "${BLUE}Test 8: Test error - non-existent order${NC}"
echo "GET /api/shipping/status/ORD-NOTEXIST"
echo ""
curl -X GET "$BASE_URL/status/ORD-NOTEXIST"
echo ""
echo ""

sleep 1

echo -e "${BLUE}Test 9: Test error - duplicate order ID${NC}"
echo "POST /api/shipping/create (with duplicate order_id)"
echo ""
curl -X POST "$BASE_URL/create" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "order_id=ORD-DEMO-001" \
  -d "recipient_name=Test Duplicate" \
  -d "recipient_address=Test Address" \
  -d "recipient_phone=081234567890" \
  -d "courier_service=JNE" \
  -d "shipping_cost=15000" \
  -d "weight=2.5"
echo ""
echo ""

sleep 1

echo -e "${BLUE}Test 10: Test validation error - missing fields${NC}"
echo "POST /api/shipping/create (with missing required fields)"
echo ""
curl -X POST "$BASE_URL/create" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "order_id=ORD-DEMO-999"
echo ""
echo ""

echo ""
echo "================================"
echo -e "${GREEN}All tests completed!${NC}"
echo "================================"
